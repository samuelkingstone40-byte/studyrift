<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Category;

class SettingController extends Controller
{
    public function subjects(){
        $data['subjects']=Subject::orderBy('name','asc')->get();
        return view('admin/subjects',$data);
    }

    public function post_subject(Request $request){
        $subject=new Subject;
        $subject->name=$request->input('name');
        $subject->save();
        return redirect()->back()->with('success', 'Subject has been added!');   

    }

    public function categories(){
        $data['categories']=Category::orderBy('name','asc')->get();
        return view('admin/categories',$data);
    }

    public function post_category(Request $request){
        $subject=new Category;
        $subject->name=$request->input('name');
        $subject->save();
        return redirect()->back()->with('success', 'Category has been added!');   

    }
}
