<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SeerbitLaravel\Facades\Seerbit;
use Knox\Pesapal\Facades\Pesapal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


use App\Models\Transaction;
use App\Models\User;
use App\Models\Order;
use App\Models\Document;
use Exception;

class PaymentController extends Controller
{
    public function make_payment(Request $request){
        $amount =$request->amount;
        $mode=$request->payment_mode;
        $email=$request->email;

        $orders=$request->input('docs');
        //convert to a string
        $orderStr=implode(',',$orders);
        //conert to array
        $arr=explode(",",$orderStr);

        Session::put("orders",$arr);
        Session::save();

       // redirect to mode of payement
        if($mode=='pesapal'){
            return $this->process_pesapal_payment($request);
        }

        if($mode== 'seerbit'){
            return $this->process_seerbit_payment($amount);
        }
     }

    //process seerbit payment
    public function process_seerbit_payment($amount){
       
       // get user information
        $user=Auth::user();
        $email=$user->email;
        $name=$user->name;

        //payment details
        $uuid = bin2hex(random_bytes(6));
        $product_id = strtoupper(trim("SB".$uuid));
        $transaction_ref = strtoupper(trim("SB".$uuid));
  
        $payload = [ 
            "amount" => $amount,
            "callbackUrl" =>'/seerbit-callback',
            "country" => "KE",
            "fullname"=>$name,
            "currency" => "KES",
            "email" => $email,
            "paymentReference" => $transaction_ref,
            "productDescription" => "product_description",
            "productId" => $product_id,
            "tokenize" => true //optional
        ];

        $resp = SeerBit::Standard()->Initialize($payload);
        if(!isset($resp["httpStatus"]) && $resp["httpStatus"] != "200"){
                abort($resp['httpStatus'],$resp['message']);
        }

        $payment_link=$resp['data']['payments']['redirectLink'];
        return redirect($payment_link);

    }

    public function handleSeerBitCallback(Request $request){

        $trans_ref="SBF9227EB2142B";
        $orders=session()->get('orders');
        
        $response = SeerBit::Standard()->ValidateStatus($trans_ref);
        $data= $response['data'];
            //check if payment was successful
        if($data['message']=='Successful'){
                
                // persist transaction to database and update orders status
                $transaction=new Transaction();
                try {
                    $transaction->user_id=Auth::user()->id;
                    $transaction->type="sales";
                    $transaction->details="Sales";
                    $transaction -> transId =$trans_ref;
                    $transaction -> status = "success"; 
                    $transaction -> amount = $data['payments']['amount'];
                    $transaction -> save();
                } catch (\Throwable $th) {
                    throw $th;
                }

                //add orders  to db id;
                for($i=0;$i< count($orders);$i++){
                    $docId=$orders[$i];
                    $this->add_orders($trans_ref,$trans_ref,$data['message'],$docId);
                }
                //$this->download_file($docId);
                //return dd($orders[$i]);
  
                return redirect('payment-complete');

            }
        
      
    }

    // get authorization token information from seerbit server
    public function get_seerbit_authorization_token(){
        $public_key = config('seerbit.public_key');
        $secret_key=  config('seerbit.secret_key');
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://seerbitapi.com/api/v2/encrypt/keys',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
              "key": "'.$secret_key.'.'.$public_key.'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $data=json_decode($response);
        if($data->status=='SUCCESS'){
         return  $data->data->EncryptedSecKey->encryptedKey;
        }

        return redirect()->back()->with('error', $data->message); 

        
    }

    // ----------------------------------------------------------------
    /** PESAPAL PAYMENTS */

    /** Process payment using paypal */
    public function process_pesapal_payment($request)
    {
        $orders=$request->input('docs');
     
        // save the transaction and mark as pending
        $transaction = new Transaction();
        try {
            $transaction->user_id=Auth::user()->id;
            $transaction->type="sales";
            $transaction->details="Sales";
            $transaction -> transId = Pesapal::random_reference();
            $transaction -> status = 0; 
            $transaction -> amount = $request->get("amount");
            $transaction -> save();
        } catch (Exception $e) {
            abort(500, $e->getMessage());
        }

        $status="Pending";
        $transId=$transaction -> transId;
        $orderId=$transaction -> transId;

         for($i=0;$i< count($orders);$i++){
            $docId=$orders[$i];
            $this->add_orders($orderId,$transId,$status,$docId);
                //$this->download_file($docId);
                //return dd($orders[$i]);
        }
        
      
        // prepare payment information to send to pesapal for processing
        $details = array(
            'amount' => $request->get('amount'),
            'description' => 'Document Sales',
            'type' => 'MERCHANT',
            'first_name' => $request->get('fname'),
            'last_name' => $request->get('lname'),
            'email' => $request->get('email'),
            'phonenumber' => $request->get('phone'),
            'reference' =>   $transaction -> transId,
            'height'=>'400px'
        );


        // Pass details to pesapal 
        $iframe=Pesapal::makePayment($details);
        if($iframe){
            for($i=0;$i< count($orders);$i++){
                $docId=$orders[$i];
                $this->add_orders($orderId,$transId,$status,$docId);
                $this->download_file($docId);
                //return dd($orders[$i]);
            }
        }
        return view('pesapal', compact('iframe'));
    }

    /** THIS function add client orders to order table */
    public function add_orders($orderId,$transId,$status,$docId)
    {
        //get the document details
        $doc=Document::find($docId); 
        if(!$doc){
           return response()->view('errors.custom', [], 400);
        }
        $user_id=Auth::user()->id;
        try {
            Order::create([
                'user_id'=>$user_id,
                'owner_id'=>$doc->user_id,
                'orderId' => $orderId,
                'transactionId'=>$transId,
                'docId'=>$doc->id,
                'earning'=>($doc->price)*0.7,
                'income'=>($doc->price)*0.3,
                'status' => 'New']);

            $message=[
            'message'=>'your document has been purchased',
            'doc_id'=>$docId,
            'slug'=>$doc->slug
        ];

        } catch (\Throwable $th) {
            return response()->view('errors.custom', [], 400);
        }
       
        
       

     //$user->notify(new PurchaseNotification($message));
    }
    //just tells u payment has gone thru..but not confirmed
    public function payment_complete(Request $request)
    {
        // get all the new purchases;
        $data=[];
        $user_id=Auth::user()->id;
        $orders=DB::table('orders')
            ->select('docId')
            ->where('user_id',$user_id)
            ->where('status','new')
            ->orderBy('id','desc')
            ->get();

        $docIds=[];
        foreach ($orders as $order) {
            $docIds[]=$order->docId;
        }

        $docIds=array_unique($docIds);
        // get the documents 

        $documents=DB::table('documents')
            ->whereIn('documents.id',$docIds)
            ->leftJoin('files','files.document_id','=','documents.id')
            ->leftJoin('subjects','subjects.id','=','documents.subject_id')
            ->leftJoin('categories','categories.id','=','documents.category_id')
            ->orderBy('documents.created_at','desc')
            ->select('documents.*','files.filename','subjects.name as subject','categories.name as category')
            ->get();

        $request->session()->forget('cart');
        $data['orders']=$documents;

        //return $data;

        //go back home
        //$payments=Payment::all();
        return view('pay-success', $data);
    }

    //This method just tells u that there is a change in pesapal for your transaction..
    //u need to now query status..retrieve the change...CANCELLED? CONFIRMED?
    public function paymentconfirmation(Request $request)
    {
        $trackingid = $request->input('pesapal_transaction_tracking_id');
        $merchant_reference = $request->input('pesapal_merchant_reference');
        $pesapal_notification_type= $request->input('pesapal_notification_type');

        //use the above to retrieve payment status now..
        $this->checkpaymentstatus($trackingid,$merchant_reference,$pesapal_notification_type);
    }
    //Confirm status of transaction and update the DB
    public function checkpaymentstatus($trackingid,$merchant_reference,$pesapal_notification_type){
    $status=Pesapal::getMerchantStatus($merchant_reference);
    $payments = Transaction::where('trackingid',$trackingid)->first();
    $payments -> status = $status;
    $payments -> payment_method = "PESAPAL";//use the actual method though...
    $payments -> save();
    return "success";
    }

    public function update_orders(){
    DB::table('orders')
    ->where('status','Available')
    ->update(['status'=>'Paid']);
    }
 
    public function download_file($docId){
        $doc=DB::table('documents')->where('documents.id',$docId)
        ->leftJoin('files','files.document_id','=','documents.id')
        ->select('documents.*','files.filename')
        ->first();

        // update status of order if its first time download

        $order=DB::table('orders')
            ->where('status','New')
            ->where('docId',$docId)
            ->where('user_id',Auth::user()->id)
            ->get();
            // ->update(['status' => 'Available']);

        return $order;
       
    
        $downloads = session()->get('downlads', []);
        $downloads[] = [
                "name" => $doc->title,
                "quantity" => 1,
                "price" => $doc->price,
                "image" =>'',
                'filename'=>$doc->filename
        ];
        
            
        session()->put('downloads', $downloads);
    
        
    
    }

    public function pay_success(Request $request){
    $request->session()->forget('cart');
    return view('pay-success');
    }


}
