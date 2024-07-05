<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function users()
    {
        return view('admin/users/index');
    }

    public function get_all_users(Request $request)
    {
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
                $actionBtn = '<a href="/admin/user-profile/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a> ';
                return $actionBtn;
            })
         
               ->rawColumns(['action','state'])
               ->make(true);
           }
    }

    public function user_profile($id)
    {
        $user=DB::table('users')
         ->where('id',$id)
         ->first();
        
         $data['user']=$user;
         $data['total_uploads']=$this->count_uploads($id);
         $data['total_downloads']=$this->count_total_downloads($id);
         $data['total_earnings']=$this->get_total_user_earnings($id);

        return view('admin/users/user-profile',$data);
    }

    public function user_uploads(Request $request,$id){
        if ($request->ajax()) {
            $data = DB::table('documents')
             ->where('documents.user_id',$id)
             ->whereNull('documents.status')
            ->leftJoin('subjects','documents.subject_id','=','subjects.id')
            ->leftJoin('categories','documents.category_id','=','categories.id')
            ->select('documents.*','subjects.name as sname','categories.name as cname')
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
            ->leftJoin('documents','documents.id','=','orders.docId')
            ->leftJoin('subjects','documents.subject_id','=','subjects.id')
            ->leftJoin('categories','documents.category_id','=','categories.id')
            ->leftJoin('files', 'documents.id', '=', 'files.document_id')
            ->select('orders.*','documents.title','documents.slug','subjects.name as sname','categories.name as cname','files.filename')
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

    public function user_transactions($id,Request $request)
    {
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

    // get total user uploads
    public function count_uploads($id)
    {
        $count=0;
        try {
            $count= $query=DB::table('documents')->where('user_id',$id)->count();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return $count;
       
    }

    // get total user downloads
    public function count_total_downloads($id)
    {
        $count=0;
        try {
            $count= $query=DB::table('orders')->where('user_id',$id)->count();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return $count;
    }

    // get total user earnings 
    public function get_total_user_earnings($id)
    {
        $earnings=0;
        try {
            $earnings= $query=DB::table('orders')->where('user_id',$id)->sum('earning');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return $earnings;
    }

    //update user settings
    public function edit_user_profile($id)
    {
       $data=[];
        try {
            $user=$query=DB::table('users')->where('id',$id)->first();
            $data['user']=$user;
        } catch (\Throwable $th) {
            return view('admin/users/edit-profile')->with('errors',$th->getMessage());
        }
        
        return view('admin/users/edit-profile',$data);
    }

    //deactivate clients account 
    public function deactivate_account($id)
    {
        try {
            $deactivate=DB::table('users')
            ->where('id', $id)
            ->update(['status' => 0]);
        } catch (\Throwable $th) {
            return view('admin/users/edit-profile')->with('errors',$th->getMessage());
        }

        return Redirect::back()->with('success','User account deactivated successfully.');
    }

        //activate clients account 
    public function activate_account($id)
    {
            try {
                $deactivate=DB::table('users')
                ->where('id', $id)
                ->update(['status' => 1]);
            } catch (\Throwable $th) {
                return view('admin/users/edit-profile')->with('errors',$th->getMessage());
            }
    
            return Redirect::back()->with('success','User account activated successfully.');
    }

}