<?php

namespace App\Http\Controllers;

use Pesapal;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction as Payment;
use App\Models\User;
use App\Models\Order;
use DB;
use App\Notifications\PurchaseNotification;

class PesapalController extends Controller
{
 
public function payment(Request $request){//initiates payment
   $orders=$request->input('docs');
   $payments = new Payment;
   $payments->user_id=0;
   $payments->type="sales";
   $payments->details="Sales";
   $payments -> transId = Pesapal::random_reference();
   $payments -> status = 0; //if user gets to iframe then exits, i prefer to have that as a new/lost transaction, not pending
   $payments -> amount = $request->get("amount");
   $payments -> save();

   $details = array(
       'amount' => $request->get('amount'),
       'description' => 'Document Sales',
       'type' => 'MERCHANT',
       'first_name' => $request->get('fname'),
       'last_name' => $request->get('lname'),
       'email' => $request->get('email'),
       'phonenumber' => $request->get('phone'),
       'reference' =>   $payments -> transId,
       'height'=>'400px',
       'currency' => 'USD'
   );
   $status="Pending";
   $transId=$payments -> transId;
   $orderId=$payments -> transId;
   $iframe=Pesapal::makePayment($details);
   if($iframe){
      for($i=0;$i< count($orders);$i++){
         if(Auth::user()){
           $this->add_orders($orderId,$transId,$status,$orders[$i]);
         }
         $docId=$orders[$i];
         $this->download_file($docId);
          //return dd($orders[$i]);
       }
   }

   return view('pesapal', compact('iframe'));
}
public function paymentsuccess(Request $request)//just tells u payment has gone thru..but not confirmed
{
   $trackingid = $request->get('tracking_id');
   $ref = $request->get('merchant_reference');
   $payments = Payment::where('transId',$ref)->first();
   $payments -> tracking_id = $trackingid;
   $payments -> status = 'PENDING';
   $payments -> save();
   //go back home
   //$payments=Payment::all();
   return view('pay-success', compact('payments'));
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
   $payments = Payment::where('trackingid',$trackingid)->first();
   $payments -> status = $status;
   $payments -> payment_method = "PESAPAL";//use the actual method though...
   $payments -> save();
   return "success";
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

     //$user->notify(new PurchaseNotification($message));
}

public function update_orders(){
   $update=DB::table('orders')

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
