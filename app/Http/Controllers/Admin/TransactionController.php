<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,DataTables;;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionController extends Controller
{
    
    public function sales(){
        return view('admin/sales');
    }
    public function get_all_sales(Request $request){
        if ($request->ajax()) {
            $data = DB::table('orders')
            ->leftJoin('notes','notes.id','=','orders.docId')
            ->leftJoin('subjects','notes.subject_id','=','subjects.id')
            ->leftJoin('categories','notes.category_id','=','categories.id')
            ->leftJoin('users','users.id','=','orders.user_id')
            ->select('orders.*','subjects.name as sname','categories.name as cname','users.name as uname')
            ->get();
            return DataTables::of($data)
           
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/admin/document-view/'.$row->id.'" class="edit btn btn-success btn-sm">View</a> ';
                    return $actionBtn;
                })
                
            ->editColumn('date', function ($data) {
                $dt = Carbon::create($data->created_at);
                return $dt->toDateString();
            })
                ->editColumn('amount', function ($data) {
                    return "$".number_format($data->earning,2);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function withdrawals(){
        return view('admin/withdrawals');
    }

    public function get_all_withdrawals(Request $request){
       
            if ($request->ajax()) {
                $data = DB::table('transactions')
                ->where('transactions.type','withdrawal')
                ->leftJoin('users','users.id','=','transactions.user_id')
                ->select('transactions.*','users.name as uname')
                ->orderBy('transactions.id','desc')
                ->get();
                return DataTables::of($data)
               
            ->editColumn('date', function ($data) {
                $dt = Carbon::create($data->created_at);
                return $dt->toDateString();
            })

            ->editColumn('cash', function ($data) {
                return "$".number_format($data->amount,2);
            })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="/admin/document-view/'.$row->id.'" class="edit btn btn-success btn-sm">View</a> ';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        
    }

    public function transactions(){
        return view('admin/transactions');
    }

    public function get_all_transactions(Request $request){
        if ($request->ajax()) {
            $data = DB::table('transactions')
            ->leftJoin('users','users.id','=','transactions.user_id')
            ->select('transactions.*','users.name as uname')
            ->orderBy('transactions.id','desc')
            ->get();
            return DataTables::of($data)
            ->editColumn('date', function ($data) {
                $dt = Carbon::create($data->created_at);
                return $dt->toDateString();
            })

            ->editColumn('cash', function ($data) {
                return "$".number_format($data->amount,2);
            })
                ->addIndexColumn()
                
                ->make(true);
        }
    }

    public function general_ledger(){
        return view('admin/general-ledger');
    }

    public function fetch_general_ledger(Request $request){
        
         $data=array();
        
        if ($request->ajax()) {
            $transactions = DB::table('transactions')
            ->leftJoin('users','users.id','=','transactions.user_id')
            ->select('transactions.*','users.name as uname')
            ->orderBy('transactions.id','asc')
            ->get();
            $bal=0.00;
            $credit=0.00;
            $debit=0.00;
            foreach($transactions as $transaction){
                if($transaction->type =='sales'){
                  $debit=$transaction->amount;
                }else{
                    $debit=0.00;
                }
                
                if($transaction->type =='withdrawal'){
                  $credit=$transaction->amount;
                }else{
                    $credit=0.00;
                }
                
                 $bal=$bal + ($debit-$credit);
                 $data[]=([
                   'id'=>$transaction->id,
                   'transdate'=>Carbon::create($transaction->created_at)->toDateString(),
                   'type'=>$transaction->type,
                   'details'=>$transaction->details,
                   'amount'=>$transaction->amount,
                   'transId'=>$transaction->transId,
                   'debit'=>number_format($debit,2),
                   'credit'=>number_format($credit,2),
                   'bal'=>number_format($bal,2)
               ]);
            }
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }


    public function account_balance(){
        
        return view('admin/balance');
    }

    public function fetch_account_balance(Request $request){
        $sales=DB::table('transactions')->where('type','sales');
        $withdrawal=DB::table('transactions')->where('type','withdrawal');
        if ($request->ajax()) {
           
        }

        $sales=$sales->sum('amount');
        $withdrawal=$withdrawal->sum('amount');

        $data['sales']="$".number_format($sales,2);
        $data['withdrawals']="$".number_format($withdrawal,2);
        $data['income']="$".number_format($sales-$withdrawal,2);
        return $data;
    }





}
