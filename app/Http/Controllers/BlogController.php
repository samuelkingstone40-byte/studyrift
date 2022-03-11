<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogs()
    {
        $data['blogs']=Blog::latest()->get();
        return view('blogs',$data);
    }

    public function adminBlog(){
        $data['blogs']=Blog::latest()->get();
        return view('admin.blogs',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-blog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'filename' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
         ]);
        $originalImage= $request->file('filename');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/blogs/thumbnail/';
        $originalPath = public_path().'/blogs/images/';
        $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(300,300);
        $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 
       Blog::create([
           'category'=>$request->category,
           'title'=>$request->title,
           'blog'=>$request->blog,
           'image'=>time().$originalImage->getClientOriginalName(),
           'slug'=>$slug = Str::slug($request->title, '-')
       
       ]);

       return redirect()->route('admin-blogs')->with('success','Blog has been posted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data['blogs']=Blog::latest()->get();
        $data['blog']=Blog::where('slug',$slug)->first();
        return view('single-blog',$data);
    }

    public function view($slug)
    {   $data['blogs']=Blog::latest()->get();
         $data['blog']=Blog::where('slug',$slug)->first();
        return view('single-blog',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['blog']=Blog::find($id);
        return view('admin.edit-blog',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        Blog::where('id',$id)
        ->update([
            'category'=>$request->category,
            'title'=>$request->title,
            'blog'=>$request->blog,
            'slug'=>Str::slug($request->title, '-')
        ]);

        return redirect()->back()->with('success','blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
    
        return redirect()->route('admin-blogs')
                        ->with('success','Blog deleted successfully');
    }
}
