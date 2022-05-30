<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\Review;
use Response;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Image;


class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetch_notifications(){
        $user=Auth::user();
        $notifications=array();
        
        foreach ($user->notifications as $key=> $notification) {
            
           
             $notifications[]=array(
                 'message'=>$notification->data,
                 'date'=>$notification->created_at->diffForHumans(),
                 'read'=>$notification->read_at,
                 'id'=>$notification->id

             );
             
            
        }
        return $notifications;
    }

    public function mark_as_read(Request $request){
        $user=Auth::user();
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
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
        $doc=Note::create($data);

        $docId=$doc->id;

        $this->uploadFile($docId,$request);

        return redirect()->route('view-document',$slug)->with('success', 'Your document upload successful');
    }

    public function edit_document($slug){
        $data['subjects']=DB::select('select * from subjects');
        $data['categories']=DB::select('select * from categories');
        $data['doc']=DB::table('notes')
        ->where('notes.slug',$slug)
        ->leftJoin('files', 'notes.id', '=', 'files.document_id')
        ->leftJoin('subjects','notes.subject_id','=','subjects.id')
        ->leftJoin('categories','notes.category_id','=','categories.id')
        ->select('notes.*','files.filename','subjects.name as sname','categories.name as cname')
        ->first();
        return view('client/edit-document',$data);
    }

    public function view_document($slug){
        $doc=DB::table('notes')
        ->where('notes.slug',$slug)
         ->leftJoin('users','users.id','=','notes.user_id')
        ->leftJoin('files', 'notes.id', '=', 'files.document_id')
        ->leftJoin('subjects','notes.subject_id','=','subjects.id')
        ->leftJoin('categories','notes.category_id','=','categories.id')
        ->select('notes.*','files.filename','subjects.name as sname','categories.name as cname','users.name as uname')
        ->first();
        $data['doc']=$doc;
        $data['purchased']=$this->check_if_purchased($doc->id);
        $data['reviews']=$this->get_fetch($doc->id);
        $data['downloads']=DB::table('orders')
        ->where('docId',$doc->id)
        ->count();
        return view('client/document-view',$data);
    }

    public function get_fetch($id){
        $reviews=DB::table('reviews')
        ->leftJoin('users','users.id','=','reviews.user_id')
        ->where('reviews.doc_id',$id)
        ->select('reviews.*','users.name')
        ->get();
        return $reviews;
    }

    public function check_if_purchased($id){
        
        $purchased=DB::table('orders')
          ->where('user_id',Auth::id())
          ->where('docId',$id)
          ->first();
        return $purchased;
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
            ->whereNull('notes.status')
            ->where('notes.user_id',Auth::id())
            ->leftJoin('subjects','notes.subject_id','=','subjects.id')
            ->leftJoin('categories','notes.category_id','=','categories.id')
            ->select('notes.*','subjects.name as sname','categories.name as cname')
            ->get();
            return DataTables::of($data)
            ->editColumn('title', function ($data) {
                return Str::limit($data->title, 25);
            })

            ->editColumn('date', function ($data) {
                return Carbon::create($data->created_at)->toDateString();
            })

            ->editColumn('cash', function ($data) {
                return "$".number_format($data->price,2);
            })
            
            ->addIndexColumn()
            ->addColumn('earning', function($row){
                $earning = number_format($row->price*0.7,2);
                return "$".$earning;
            })
            ->addColumn('image', function($row){
                    $fileimage = '<img class="img-thumbnail" width="60" src="'.$row->image.'"/>';
                    return $fileimage;
            })
            ->addColumn('action', function($row){
                    $actionBtn = '<a href="view-document/'.$row->slug.'" class="genric-btn primary small"><i class="fa fa-eye fa-lg"></i></a> <a href="/edit-document/'.$row->slug.'" class="genric-btn info small"><i class="fa fa-pencil fa-lg"></i></a>';
                    return $actionBtn;
            })
                ->rawColumns(['image','earning','action'])
                ->make(true);
        }
    }

    public function uploads(){
        $data['notes']=DB::table('notes')
          ->whereNull('notes.status')
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
        ->select('orders.*','notes.title','notes.price','notes.image','notes.slug','subjects.name as sname','categories.name as cname','files.filename')
        ->orderBy('orders.id','desc')
        ->get();
        return DataTables::of($data)
        ->editColumn('title', function ($data) {
            return Str::limit($data->title, 25);
        })

        ->editColumn('date', function ($data) {
            return Carbon::create($data->created_at)->toDateString();
        })
        
        ->addIndexColumn()
        ->addColumn('image', function($row){
            $fileimage = '<img class="img-thumbnail" width="70" src="'.$row->image.'"/>';
            return $fileimage;
        })
         ->addColumn('action', function($row){
                $actionBtn = '<a href="/view-document/'.$row->slug.'" class="genric-btn primary small">Download <i class="fa fa-download" aria-hidden="true"></i>
                </a>';
                return $actionBtn;
            })
            ->rawColumns(['image','action'])
            ->make(true);
        }
    }


    public function earnings(){
        $data['current_earnings']=DB::table('orders')
        ->where('owner_id',Auth::id())
        ->where('status','Available')
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
            ->select('orders.*','notes.title','notes.price','notes.slug','subjects.name as sname','categories.name as cname','files.filename')
            ->get();
            return DataTables::of($data)
            ->editColumn('title', function ($data) {
                return Str::limit($data->title, 20);
            })

            ->editColumn('date', function ($data) {
                return Carbon::create($data->created_at)->toDateString();
            })

            ->addColumn('earning', function($data){
                $earning = number_format($data->price*0.7,2);
                return "$".$earning;
            })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/download/'.$row->filename.'" class="edit btn btn-success btn-sm">Download <i class="fa fa-download" aria-hidden="true"></i>
                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['earning','action'])
                ->make(true);
            }
    }

    public function post_review(Request $request){
        $review=Review::create([
            'user_id'=>Auth::id(),
            'doc_id'=>$request->input('docId'),
            'review'=>$request->input('review'),
            'rating'=>$request->input('rating')
        ]);
        return redirect()->back()->with('success', 'Your review have been submited');   
    }

    public function upload_profile_img(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
       if ($files = $request->file('image')) {
        $ImageUpload = Image::make($files);
        $originalPath = public_path().'/profiles/';
        $ImageUpload->save($originalPath.$files->getClientOriginalName());
     
    // for save thumnail image
        $thumbnailPath = public_path().'/thumbnails/';
        $ImageUpload->resize(250,125);
        $ImageUpload = $ImageUpload->save($thumbnailPath.$files->getClientOriginalName());
 
   

            $user_info=User::find(Auth::id());
            $user_info->image =$files->getClientOriginalName();
            $user_info->save();

        return redirect()->back()->with('success', 'Your profile image has been uploaded');   

    }
}

public function file_delete($id){
    $file=DB::table('notes')
    ->where('id',$id)
    ->update(['status'=>0]);
    return redirect('uploads')->with('success', 'file deleted successfuly!'); 
}

}
