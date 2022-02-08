<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,DataTables;;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin/dashboard');
    }

    public function users(){
        return view('admin/users');
    }

    public function get_all_users(Request $request){
        if ($request->ajax()) {
           $data=DB::table('users')
           ->get();
           return DataTables::of($data)
          
               ->addIndexColumn()
               ->addColumn('action', function($row){
                   $actionBtn = ''
                   ;
                   return $actionBtn;
               })
               ->rawColumns(['action'])
               ->make(true);
           }
       }
    public function uploads(){
        return view('admin/uploads');
    }

    public function get_all_uploads(Request $request){
        if ($request->ajax()) {
            $data = DB::table('notes')
            ->leftJoin('subjects','notes.subject_id','=','subjects.id')
            ->leftJoin('categories','notes.category_id','=','categories.id')
            ->select('notes.*','subjects.name as sname','categories.name as cname')
            ->get();
            return DataTables::of($data)
            ->editColumn('title', function ($data) {
                return Str::limit($data->title, 50);
            })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/document-preview/'.$row->slug.'" class="edit btn btn-success btn-sm">View</a> ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

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
                    $actionBtn = '<a href="/document-preview/'.$row->id.'" class="edit btn btn-success btn-sm">View</a> ';
                    return $actionBtn;
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
               
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="/document-preview/'.$row->id.'" class="edit btn btn-success btn-sm">View</a> ';
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
           
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/document-preview/'.$row->id.'" class="edit btn btn-success btn-sm">View</a> ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
   
}
