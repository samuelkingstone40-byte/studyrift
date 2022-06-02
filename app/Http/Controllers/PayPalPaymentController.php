<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction as Transactions;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\Currency;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Payout;
use PayPal\Api\PayoutItem;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\Notifications\PurchaseNotification;
class PayPalPaymentController extends Controller
{

  public function __construct()
  {
     
      /** PayPal api context **/
      $paypal_conf = \Config::get('paypal');
      $this->_api_context = new ApiContext(new OAuthTokenCredential(
          $paypal_conf['client_id'],
          $paypal_conf['secret'])
      );
      $this->_api_context->setConfig($paypal_conf['settings']);

  }

  public function verify(Request $request){
    $accessToken="FLWSECK_TEST-74893c254744408619f23efe48f0c3de-X";
    $curl= curl_init();
    curl_setopt_array($curl,array(
        CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/3192844/verify",
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_CUSTOMREQUEST=>'GET',
        CURLOPT_HTTPHEADER=>array("Content-Type: application/json","Authorization: Bearer ".$accessToken),
    ));

      $response=curl_exec($curl);
      curl_close($curl);

      $res=json_decode($response);

     // return $res->data;

      if($res->status=='success'){
      $amount=$res->data->amount;
      $orders=$request->get('docs');
      $orderId=$res->data->flw_ref;
      $transId=$request->transid;
      $status="Avaialble";

      for($i=0;$i< count($orders);$i++){
        if(Auth::user()){
          $this->add_orders($orderId,$transId,$status,$orders[$i]);
        }
        $docId=$orders[$i];
        $this->download_file($docId);
         //return dd($orders[$i]);
      }

      $this->sales_transaction($amount,$transId,$status);

     return "success";
    }

}
 
  public function capturePayment(Request $request){
      $amount=$request->get('orders')[0]['amount']['value'];
      $orders=$request->get('docs');
      $orderId=$request->get('orderId');
      $transId=$request->get('id');
      $status=$request->get('status');

      for($i=0;$i< count($orders);$i++){
        $this->add_orders($orderId,$transId,$status,$orders[$i]);
        $docId=$orders[$i];
        $this->download_file($docId);
         //return dd($orders[$i]);
      }

      $this->sales_transaction($amount,$transId,$status);
    
        //return dd($request->all());
       //$order = Order::create(['orderId' => $request->get('orderId'),
                      // 'status' => $request->get('status'),
                      /// 'payerEmail' => $request->get('payerEmail')]);

       //Code to Email Book To User

       //return $order;
   }

   public function add_orders($orderId,$transId,$status,$docId)
   {
       $doc=DB::table('notes')->where('id',$docId)->first();
       $user_id=Auth::id();
       $order = Order::create([
                'user_id'=>$user_id,
                'owner_id'=>$doc->user_id,
                'orderId' => $orderId,
                'transactionId'=>$transId,
                'docId'=>$docId,
                'earning'=>($doc->price)*0.7,
                'income'=>($doc->price)*0.3,

                'status' => 'Available']);
        $user=User::where('id',$doc->user_id)->first();
        $message=[
            'message'=>'your document has been purchased',
            'doc_id'=>$docId,
            'slug'=>$doc->slug
        ];

        $user->notify(new PurchaseNotification($message));
   }

   public function sales_transaction($amount,$transId,$status){
    if(Auth::user())
    {
    $user_id=Auth::id();
    }else{
      $user_id='000000';
    }
    $order = Transactions::create([
             'transId'=>$transId,
             'user_id'=>$user_id,
             'type'=>'sales',
             'amount'=>$amount,
             'details'=>"Document sales",
             'status' => 1]);
       
   }

   public function pay_failed(){
       return view('pay-failed');
   }
   public function pay_success(Request $request){
    $request->session()->forget('cart');
    return view('pay-success');
   }
   public function pay_pal_accessToken(){
    $client ="AZR8hLRpmE4st9mF0yAH7uLs8OwAh8vuUKNu1sGCkvr_95Sr_m34NFKxGK0IlUw_8SfafXw7IKcF4_1u";
    $secret= "EFQWaoIk03r2wjjpVJjWejtSx0ImNFYFKinwYGQ2SxikBeoOK3fXdsVMKKJVCGGgbIvP8rXVwqMy15Tp";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api-m.paypal.com/v1/oauth2/token");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $client.":".$secret);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $result = curl_exec($ch);

    if(empty($result))die("Error: No response.");
    else
    {
    $json = json_decode($result); 
    $accessToken=$json->access_token;
    return $accessToken;
    }
}
   public function paypalpayout(Request $request){
    $accessToken=$this->pay_pal_accessToken();

    
    $user=Auth::user();
    $user_email=$user->paypalEmail;

    $amount=DB::table('orders')
      ->where('owner_id',Auth::id())
      ->where('status','Available')
      ->sum('earning');
    
      $data='{

        "sender_batch_header": {
            "sender_batch_id": "Payouts_'.uniqid().'",
            "email_subject": "Studymerit Payout",
            "email_message": "You have received a payout! Thanks for using our Studymerit!"
          },
          "items": [
            {
              "recipient_type": "EMAIL",
              "amount": {
                "value": "'.$amount.'",
                "currency": "USD"
              },
              "note": "Thanks for your patronage!",
              "sender_item_id": "'.$user->id.'",
              "receiver": "'.$user_email.'"

            }
            
          ]
    }';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api-m.paypal.com/v1/payments/payouts");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$accessToken));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $json = json_decode($result);

   return dd($json);
    $state=$json->batch_header;
    if($state->batch_status =='PENDING'){
  
      $transaction=new Transactions;
      $transaction->transId=$state->payout_batch_id;
      $transaction->user_id=Auth::id();
      $transaction->amount=$amount;
      $transaction->type='withdrawal';
      $transaction->details='User withdrawal';
      $transaction->status=1;
      $transaction->save();

      $this->update_orders();
      return redirect()->back()->with('success', 'Your payment has been processed successful');
    
    }
 
    
}

public function update_orders(){
  $update=DB::table('orders')
  ->where('owner_id',Auth::id())
  ->where('status','Available')
  ->update(['status'=>'Paid']);
}

public function download_file($docId){
    $doc=DB::table('notes')->where('notes.id',$docId)
    ->leftJoin('files','files.document_id','=','notes.id')
    ->select('notes.*','files.filename')
    ->first();
 
      $downloads = session()->get('downlads', []);
     
          $downloads[] = [
              "name" => $doc->title,
              "quantity" => 1,
              "price" => $doc->price,
              "image" => $doc->image,
              'filename'=>$doc->filename
          ];
      
         
      session()->put('downloads', $downloads);

    
  
}

   
}
