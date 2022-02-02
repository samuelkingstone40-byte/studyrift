<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\File;



class ClientController extends Controller
{
    
    
    public function sell(){
        $data['subjects']=DB::select('select * from subjects');
        $data['categories']=DB::select('select * from categories');

        return view('client/sell',$data);
    }

    public function post_document(Request $request){

        $file = $request->file('file');
        $title = $request->input('title');
        $subject = $request->input('subject');
        $category = $request->input('category');
        $detail = $request->input('detail');
        $price=$request->input('price');
        $slug = \Str::slug($request->input('title'));
        $user=1;
      
        $data=array('user_id'=>$user,'title'=>$title,"subject_id"=>$subject,"category_id"=>$category,
        "description"=>$detail,"price"=>$price,"year"=>'2022','slug'=>$slug);
        $docId=DB::table('notes')->insertGetId($data);

        $this->uploadFile($docId,$request);
       // return redirect('upload-files/'.$docId);
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
        return view('client/profile');
    }

    public function upload_files($id){
        $data['docId']=$id;
        $data['notes']=DB::select('select * from notes');
        return view('client/upload-files',$data);
    }

    public function uploadFile($docId , $request){

    //     $this->validate($request, [
    //         'file' => 'required|image|mimes:png,pdf,docx|max:2048',
    //     ]);

    //     $image = $request->file('file');
    //     $input['file'] = time().'.'.$image->getClientOriginalName();
        
    //     $destinationPath = public_path().'/storage/thumbnails/';

    //     $imgFile = Image::make($image->getRealPath());

    //    $imgFile->resize(150, 150, function ($constraint) {
	// 	    $constraint->aspectRatio();
	// 	})->save($destinationPath.'/'.$input['file']);
    //      // $image->save($destinationPath, 80, 'jpg');
    //     $destinationPath = public_path().'/storage/files/' ;
    //     $image->move($destinationPath, $input['file']);

    //     return back()
    //     	->with('success','Image has successfully uploaded.')
    //     	->with('fileName',$input['file']);




     
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
}
