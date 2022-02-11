<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction as Transactions;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
 
  public function capturePayment(Request $request){
    

      $amount=$request->get('orders')[0]['amount']['value'];
      $orders=$request->get('docs');
      $orderId=$request->get('orderId');
      $transId=$request->get('id');
      $status=$request->get('status');

      for($i=0;$i< count($orders);$i++){
        $this->add_orders($orderId,$transId,$status,$orders[$i]);
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
    $user_id=Auth::id();
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

   public function paypalpayout(Request $request){

    // $userid=auth('sanctum')->user()->Id;
    // $user=User::find($userid);

    $amount=DB::table('orders')
    ->where('owner_id',Auth::id())
    ->where('status','COMPLETED')
    ->sum('earning');
    $payouts=new Payout();
    $senderBatchHeader  = new PayoutSenderBatchHeader();

    

    $senderBatchHeader->setSenderBatchId(uniqid())
        ->setEmailSubject("BrainySolver Payment ");

    $senderItem =   new PayoutItem();
    $senderItem->setRecipientType('Email')
        ->setNote("Brainy Solver New Payment")
        ->setReceiver('sb-tvg5d507654@personal.example.com')
        ->setSenderItemId(uniqid())
        ->setAmount(new Currency('{
        "value":"'.$amount.'",
        "currency":"USD"
        }'));

    $payouts->setSenderBatchHeader($senderBatchHeader)
        ->addItem($senderItem);
      
    $request= clone $payouts;
   
    try{
      $output = $payouts->create(array('sync_mode' => 'false'), $this->_api_context);
            }catch (Exception $ex){
        return $ex->getMessage();
    }
   

    //record transaction
    if($output->batch_header->batch_status =='PENDING')
    {
      
      //return redirect()->back()->with('success', 'Your payment has been processed successful');   
     $transaction=new Transactions;
     $transaction->transId=$output->batch_header->payout_batch_id;
     $transaction->user_id=Auth::id();
     $transaction->amount=$amount;
     $transaction->type='withdrawal';
     $transaction->details='User withdrawal';
     $transaction->status=1;
     $transaction->save();

     $this->update_orders();
     return redirect()->back()->with('success', 'Your payment has been processed successful');   
    }
    else{
    return response()->json('failed');

    }
}

public function update_orders(){
  $update=DB::table('orders')
  ->where('owner_id',Auth::id())
  ->where('status','Available')
  ->update(['status'=>'Paid']);
}
   
}
