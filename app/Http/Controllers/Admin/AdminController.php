<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function dashboard(){
        $data['totalUploads']=DB::table('documents')->count();
        $data['totalDownloads']=DB::table('orders')->count();
        $data['withdrawals']=$this->total_withdrawal();
        $data['topDownloads']=$this->top_downloads();
        $data['totalIncome']=$this->total_income();
        return view('admin/dashboard',$data);
    }

    public function total_withdrawal(){
        $withdrawals=DB::table('transactions')
        ->where('type','withdrawal')
        ->sum('amount');

        return $withdrawals;
    }

    public function total_income(){
        $income=DB::table('orders')
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('income');

        return $income;

    }

    public function top_downloads(){
        $downloads=DB::table('orders')
        ->leftJoin('documents','documents.id','=','orders.docId')
        ->leftJoin('subjects','subjects.id','=','documents.subject_id')
        ->leftJoin('categories','categories.id','=','documents.category_id')
        ->groupBy('orders.docId','orders.earning','documents.slug','documents.title','subjects.name','categories.name')
        ->orderBy(DB::raw('COUNT(orders.earning)'), 'desc')
        ->limit(10)
        ->select('orders.docId', DB::raw("COUNT(orders.docId) as count_click"),DB::raw("sum(orders.earning) as sum_earning"),
        'documents.slug','documents.title','subjects.name as sname','categories.name as cname')
        ->get();

        return $downloads;
    }

   


}
