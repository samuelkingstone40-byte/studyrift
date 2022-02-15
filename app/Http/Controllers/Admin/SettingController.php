<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;


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

    public function view_subject($id){
        return view('admin/edit-subject');
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

    public function profile(){
        return view('admin/profile');
    }

    public function system_users(){
        $data['admins']=Admin::get();
        return view('admin.admins',$data);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function post_user(Request $request){
        $this->validator($request->all())->validate();
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_super'=>0,
        ]);

        return redirect()->back()->with('success', 'User has been added!'); 
    }
}
