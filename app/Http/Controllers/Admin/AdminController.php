<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,DataTables;;
use Illuminate\Support\Str;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function dashboard(){
        $data['totalUploads']=DB::table('notes')->count();
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
        ->groupBy('orders.docId','orders.earning')
        ->orderBy(DB::raw('COUNT(orders.earning)'), 'desc')
        ->select('orders.docId', DB::raw("COUNT(orders.docId) as count_click"),DB::raw("sum(orders.earning) as sum_earning"))
        ->get();

        return $downloads;
    }

   

    public function users(){
        return view('admin/users');
    }

    public function get_all_users(Request $request){
        if ($request->ajax()) {
           $data=DB::table('users')
           ->where('role',0)
           ->get();
           return DataTables::of($data)
           ->editColumn('date', function ($data) {
            $dt = Carbon::create($data->created_at);
            return $dt->toDateString();
        })
        ->addColumn('state', function ($data) {
            $status=$data->status;
            if($status==0){
                return '<span class="badge badge-danger">Deactivated</span>';
            }elseif($status==1){
                return '<span class="badge badge-success">activate</span>';
            }
            
        })
               ->addIndexColumn()
               ->addColumn('action', function($row){
                $actionBtn = '<a href="/admin/user-profile/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i> Manage</a> ';
                return $actionBtn;
            })
         
               ->rawColumns(['action','state'])
               ->make(true);
           }
    }

    public function user_profile($id){
        $user=DB::table('users')
         ->where('id',$id)
         ->first();
        
         $data['user']=$user;
        return view('admin/user-profile',$data);
    }

    public function user_uploads(Request $request,$id){
        if ($request->ajax()) {
            $data = DB::table('notes')
             ->where('notes.user_id',$id)
            ->leftJoin('subjects','notes.subject_id','=','subjects.id')
            ->leftJoin('categories','notes.category_id','=','categories.id')
            ->select('notes.*','subjects.name as sname','categories.name as cname')
            ->get();
            return DataTables::of($data)
            ->editColumn('date', function ($data) {
                $dt = Carbon::create($data->created_at);
                return $dt->toDateString();
            })
            
            ->editColumn('title', function ($data) {
                return Str::limit($data->title, 25);
            })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/document-preview/'.$row->slug.'" class="edit btn btn-success btn-sm"><i class="fa fa-eye"></i> pre-view</a> ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function user_downloads($id,Request $request){
        if ($request->ajax()) {
            $data=DB::table('orders')
            ->where('orders.user_id',$id)
            ->leftJoin('notes','notes.id','=','orders.docId')
            ->leftJoin('subjects','notes.subject_id','=','subjects.id')
            ->leftJoin('categories','notes.category_id','=','categories.id')
            ->leftJoin('files', 'notes.id', '=', 'files.document_id')
            ->select('orders.*','notes.title','notes.slug','subjects.name as sname','categories.name as cname','files.filename')
            ->orderBy('orders.id','desc')
            ->get();
            return DataTables::of($data)
            ->editColumn('title', function ($data) {
                return Str::limit($data->title, 20);
            })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/download/'.$row->filename.'" class="edit btn btn-success btn-sm">Download <i class="fa fa-download" aria-hidden="true"></i>
                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
    }

    public function user_transactions($id,Request $request){
        if ($request->ajax()) {
            $data = DB::table('transactions')
            ->where('transactions.user_id',$id)
            ->leftJoin('users','users.id','=','transactions.user_id')
            ->select('transactions.*','users.name as uname')
            ->orderBy('transactions.id','desc')
            ->get();
            return DataTables::of($data)
            ->editColumn('date', function ($data) {
                $dt = Carbon::create($data->created_at);
                return $dt->toDateString();
            })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/document-preview/'.$row->id.'" class="edit btn btn-success btn-sm">View</a> ';
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
            ->leftJoin('users','users.id','=','notes.user_id')
            ->leftJoin('subjects','notes.subject_id','=','subjects.id')
            ->leftJoin('categories','notes.category_id','=','categories.id')
            ->select('notes.*','subjects.name as sname','categories.name as cname','users.name as uname')
            ->get();
            return DataTables::of($data)
            ->editColumn('title', function ($data) {
                return Str::limit($data->title, 30);
            })

            ->editColumn('amount', function ($data) {
                return number_format($data->price,2);
            })

            ->editColumn('date', function ($data) {
                $dt = Carbon::create($data->created_at);
                return $dt->toDateString();
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

    public function document_view($id){
        $data['doc']=DB::table('notes')
        ->where('notes.id',$id)
         ->leftJoin('users','users.id','=','notes.user_id')
        ->leftJoin('files', 'notes.id', '=', 'files.document_id')
        ->leftJoin('subjects','notes.subject_id','=','subjects.id')
        ->leftJoin('categories','notes.category_id','=','categories.id')
        ->select('notes.*','files.filename','subjects.name as sname','categories.name as cname','users.name as uname')
        ->first();

        $data['downloads']=DB::table('orders')
        ->where('docId',$id)
        ->count();
        return view('admin/document',$data);
    }
   
}
