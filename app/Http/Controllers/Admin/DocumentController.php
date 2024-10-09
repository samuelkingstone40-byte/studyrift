<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        try {
            if ($request->ajax()) {
                // Fetch the data from the database
                $data = DB::table('documents')
                    ->leftJoin('users', 'users.id', '=', 'documents.user_id')
                    ->leftJoin('subjects', 'documents.subject_id', '=', 'subjects.id')
                    ->leftJoin('categories', 'documents.category_id', '=', 'categories.id')
                    ->select('documents.*', 'subjects.name as sname', 'categories.name as cname', 'users.name as uname')
                    ->get();
    
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('title', function ($data) {
                        return $data->title ? Str::limit($data->title, 30) : 'N/A';
                    })
                    ->editColumn('sname', function ($data) {
                        return $data->sname ?? 'N/A';
                    })
                    ->editColumn('cname', function ($data) {
                        return $data->cname ?? 'N/A';
                    })
                    ->editColumn('amount', function ($data) {
                        return $data->price !== null ? number_format($data->price, 2) : '0.00';
                    })
                    ->editColumn('date', function ($data) {
                        return $data->created_at ? Carbon::create($data->created_at)->toDateString() : 'N/A';
                    })
                    ->addColumn('action', function ($row) {
                        return '<a href="/admin/documents/view/'.$row->id.'" class="btn-view">View</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error fetching uploads: ' . $e->getMessage());
    
            // Return a JSON error message
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching the uploads. Please try again later.'
            ], 500);
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