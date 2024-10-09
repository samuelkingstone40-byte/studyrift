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

class DocumentController extends Controller
{
    public function uploads()
    {
        return view('admin/documents/uploads');
    }

    public function fetch_uploads(Request $request)
    {
        $limit = $request->input('length'); // Number of records to fetch
    $start = $request->input('start');   // Offset
        if ($request->ajax()) {
            $data = DB::table('documents')
            ->leftJoin('users','users.id','=','documents.user_id')
            ->leftJoin('subjects','documents.subject_id','=','subjects.id')
            ->leftJoin('categories','documents.category_id','=','categories.id')
            ->select('documents.*','subjects.name as sname','categories.name as cname','users.name as uname')
            ->limit($limit)
            ->offset($start)->get(); // Apply offset
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
                    $actionBtn = '<a href="/admin/documents/view/'.$row->id.'" class="btn-view">View</a> ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function downloads()
    {
        return view('admin/documents/downloads');
    }

    public function fetch_downloads(Request $request){
        if ($request->ajax()) {
            $data = DB::table('orders')
            ->leftJoin('documents','documents.id','=','orders.docId')
            ->leftJoin('subjects','documents.subject_id','=','subjects.id')
            ->leftJoin('categories','documents.category_id','=','categories.id')
            ->leftJoin('users','users.id','=','orders.user_id')
            ->select('orders.*','subjects.name as sname','categories.name as cname','users.name as uname')
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

    public function view($id)
    {
        $data['doc']=DB::table('documents')
        ->where('documents.id',$id)
         ->leftJoin('users','users.id','=','documents.user_id')
        ->leftJoin('files', 'documents.id', '=', 'files.document_id')
        ->leftJoin('subjects','documents.subject_id','=','subjects.id')
        ->leftJoin('categories','documents.category_id','=','categories.id')
        ->select('documents.*','files.filename','subjects.name as sname','categories.name as cname','users.name as uname')
        ->first();

        $data['downloads']=DB::table('orders')
        ->where('docId',$id)
        ->count();
        return view('admin/documents/view',$data);
    }

    public function delete_file($id)
    {
        $file=DB::table('documents')
        ->where('id',$id)
        ->update(['status'=>0]);
        return redirect()->back()->with('success', 'file deleted successfuly!'); 
    }

    public function deactivate($id){
        try {
            $deactivate=DB::table('documents')
            ->where('id', $id)
            ->update(['status' => 1]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }

        return Redirect::back()->with('success','Document deactivated successfully.');
       
    }

    public function publish($id){
        try {
            $deactivate=DB::table('documents')
            ->where('id', $id)
            ->update(['status' => NULL]);
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }

        return Redirect::back()->with('success','Document published successfully.');
       
    }
   
}