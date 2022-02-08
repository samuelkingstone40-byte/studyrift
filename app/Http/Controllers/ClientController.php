<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Response;
use Illuminate\Support\Facades\Hash;




class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function sell(){
        $data['subjects']=DB::select('select * from subjects');
        $data['categories']=DB::select('select * from categories');

        return view('client/sell',$data);
    }

    public function post_document(Request $request){
     
        $image = $request->input('thumb');
        $title = $request->input('title');
        $subject = $request->input('subject');
        $category = $request->input('category');
        $detail = $request->input('detail');
        $price=$request->input('price');
        $slug = \Str::slug($request->input('title'));
        $user=Auth::id();
        $code=$request->input('code');
      
        $data=array('user_id'=>$user,'title'=>$title,"subject_id"=>$subject,"category_id"=>$category,
        "description"=>$detail,"price"=>$price,'slug'=>$slug,'image'=>$image,'code'=>$code);
        $docId=DB::table('notes')->insertGetId($data);

        $this->uploadFile($docId,$request);

        return redirect()->route('uploads')->with('success', 'Your document upload successful');
    }

    public function edit_document($slug){
        $data['doc']=DB::table('notes')
        ->where('notes.slug',$slug)
        ->leftJoin('files', 'notes.id', '=', 'files.document_id')
        ->leftJoin('subjects','notes.subject_id','=','subjects.id')
        ->leftJoin('categories','notes.category_id','=','categories.id')
        ->select('notes.*','files.filename','subjects.name as sname','categories.name as cname')
        ->first();
        return view('client/edit-document',$data);
    }

    public function notes_update(Request $request){
        $slug = \Str::slug($request->input('title'));
        $notes=DB::table('notes')
        ->where('id',$request->get("id"))
        ->update([
            'title'=>$request->get('title'),
            'subject_id'=>$request->get('subject'),
            'category_id'=>$request->get('category'),
            'code'=>$request->get('code'),
            'description'=>$request->get('description'),
            'price'=>$request->get('price'),
            'slug'=>$slug
        ]);
        return redirect()->back()->with('success', 'Your details have been updated');   

    }

    public function file_update(Request $request){
        $data = array();
        $validator = Validator::make($request->all(), [
             'file' => 'required|mimes:,pdf,docx|max:5120'
        ]);
        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file');// Error response

        }else{
             if($request->file('file')) {

                 $file = $request->file('file');
                 $filename = time().'_'.$file->getClientOriginalName();
              
                  //File upload location
                  $location = 'files/';

                 // Upload file
                  $file->move($location,$filename);

                  $file=DB::table('files')
                  ->where('document_id',$request->get('id'))
                  ->update([
                      'filename'=>$filename
                  ]);

                 // Response
                 return redirect()->back()->with('success', 'Your details have been updated');   

             }else{
                   //Response
                   $data['success'] = 0;
                   $data['message'] = 'File not uploaded.'; 
             }
        }

         return response()->json($data);
    }

    public function my_uploads(Request $request){
        if ($request->ajax()) {
            $data = DB::table('notes')
            ->where('notes.user_id',Auth::id())
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
                    $actionBtn = '<a href="/document-preview/'.$row->slug.'" class="edit btn btn-success btn-sm"><i class="fa fa-eye"></i> pre-view</a> <a href="/edit-document/'.$row->slug.'" class="delete btn btn-primary btn-sm">Edit</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function uploads(){
        $data['notes']=DB::table('notes')
         ->leftJoin('files', 'notes.id', '=', 'files.document_id')
         ->leftJoin('subjects','notes.subject_id','=','subjects.id')
         ->leftJoin('categories','notes.category_id','=','categories.id')
         ->select('notes.*','files.filename','subjects.name as sname','categories.name as cname')
         ->get();
        return view('client/uploads',$data);
    }

    public function profile(){
        $data['user']=Auth::user();
        return view('client/profile',$data);
    }

    public function update_profile(Request $request){
        $user=DB::table('users')
         ->where('id',Auth::id())
         ->update([
             'name'=>$request->get('name'),
             'email'=>$request->get('email')
         ]);
         return redirect()->back()->with('success', 'Your details have been updated');   

    }
    public function update_paypal(Request $request){
        $user=DB::table('users')
         ->where('id',Auth::id())
         ->update([
             'paypalEmail'=>$request->get('paypal')
         ]);
         return redirect()->back()->with('success', 'Your paypal email has been updated');   

    }

    public function update_password(Request $request){
        
        $request->validate([
            'password' => [
                'required',
                'confirmed'
               
            ],
        ]);

        $user=DB::table('users')
        ->where('id',Auth::id())
        ->update([
            'password'=>Hash::make($request->get('password'))
        ]);
        return redirect()->back()->with('success', 'Your password has been has been updated');   
    }

    public function deactivate_account(Request $request){
        $user=DB::table('users')
        ->where('id',Auth::id())
        ->update([
            'status'=>0
        ]);
        return redirect('/')->with(Auth::logout());
    }

    public function upload_files($id){
        $data['docId']=$id;
        $data['notes']=DB::select('select * from notes');
        return view('client/upload-files',$data);
    }

    public function uploadFile($docId , $request){
          $data = array();

          $validator = Validator::make($request->all(), [
               'file' => 'required|mimes:,pdf,docx|max:5120'
          ]);

          if ($validator->fails()) {
 
              $data['success'] = 0;
              $data['error'] = $validator->errors()->first('file');// Error response

          }else{
               if($request->file('file')) {

                   $file = $request->file('file');
                   $filename = time().'_'.$file->getClientOriginalName();
                
                    //File upload location
                    $location = 'files/';

                   // Upload file
                    $file->move($location,$filename);

                    $db_file = new File([
                        "document_id"=>$docId,
                        "filename" => $filename,
                        "file_ext" => "jpg",
                    ]);
                    $db_file->save(); // Finally, save the record.

                   // Response
                    $data['success'] = 1;
                    $data['message'] = 'Uploaded Successfully!';

               }else{
                     //Response
                     $data['success'] = 0;
                     $data['message'] = 'File not uploaded.'; 
               }
          }

           return response()->json($data);
     
    }

    public function downloads(){
        return view('client/downloads');
    }

    public function fetch_downloads(Request $request){
     if ($request->ajax()) {
        $data=DB::table('orders')
        ->where('orders.user_id',Auth::id())
        ->leftJoin('notes','notes.id','=','orders.docId')
        ->leftJoin('subjects','notes.subject_id','=','subjects.id')
        ->leftJoin('categories','notes.category_id','=','categories.id')
        ->leftJoin('files', 'notes.id', '=', 'files.document_id')
        ->select('orders.*','notes.title','notes.slug','subjects.name as sname','categories.name as cname','files.filename')
        ->orderBy('orders.id','desc')
        ->get();
        return DataTables::of($data)
        ->editColumn('title', function ($data) {
            return Str::limit($data->title, 50);
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

    public function download_file($filename){
        $filepath = public_path('files/'.$filename);
        return Response::download($filepath); 
    }

    public function earnings(){
        $data['current_earnings']=DB::table('orders')
        ->where('owner_id',Auth::id())
        ->where('status','COMPLETED')
        ->sum('earning');

        $data['total_earnings']=DB::table('orders')
        ->where('owner_id',Auth::id())
        ->sum('earning');
        return view('client/earnings',$data);
    }

    public function fetch_earnings(Request $request){
        if ($request->ajax()) {
            $data=DB::table('orders')
            ->where('orders.owner_id',Auth::id())
            ->leftJoin('notes','notes.id','=','orders.docId')
            ->leftJoin('subjects','notes.subject_id','=','subjects.id')
            ->leftJoin('categories','notes.category_id','=','categories.id')
            ->leftJoin('files', 'notes.id', '=', 'files.document_id')
            ->select('orders.*','notes.title','notes.slug','subjects.name as sname','categories.name as cname','files.filename')
            ->get();
            return DataTables::of($data)
            ->editColumn('title', function ($data) {
                return Str::limit($data->title, 50);
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
}
