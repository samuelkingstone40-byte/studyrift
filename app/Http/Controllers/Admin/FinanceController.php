<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class FinanceController extends Controller
{
    public function index()
    {
        $summary=$this->financial_summary();
        $data['summary']=$summary;
        return view('admin/finance/index',$data);
    }

    public function financial_summary()
    {
       
        $total_sales=0;
        $total_income=0;
        $total_payout=0;
        $available_funds=0;

        try {
            $total_sales=DB::table('transactions')->sum('amount');
            $total_income=DB::table('orders')->sum('income');
            $total_payout=DB::table('orders')->sum('earning');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }

        //get total sales
        $summary=[
            'total_sales'=>$total_sales,
            'total_income'=>$total_income,
            'total_payouts'=>$total_payout,
            'available_funds'=>$available_funds
        ];

        return $summary;
    }

    public function latest_sales(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('orders')
            ->leftJoin('documents','documents.id','=','orders.docId')
            ->select('orders.*','documents.title as name')
            ->limit(10)
            ->orderBy('created_at','DESC')
            ->get();
            return DataTables::of($data)
           
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/admin/documents/view/'.$row->docId.'" class="btn-view">View</a> ';
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
}