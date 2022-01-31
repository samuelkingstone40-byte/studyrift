<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function sell(){
        return view('client/sell');
    }

    public function post_document(Request $request){
        $title = $request->input('title');
        $subject = $request->input('subject');
        $category = $request->input('category');
        $detail = $request->input('detail');
        $price=$request->input('price');
        $user=auth()->user()->id;

        $data=array('user_id'=>$user,'title'=>$title,"subject_id"=>$subject,"category_id"=>$category,
        "description"=>$detail,"price"=>$price,"year"=>'2022');
        DB::table('notes')->insert($data);
        return redirect('uploads')->with('status',"Insert successfully");
    }

    public function uploads(){
        return view('client/uploads');
    }

    public function profile(){
        return view('client/profile');
    }
}
