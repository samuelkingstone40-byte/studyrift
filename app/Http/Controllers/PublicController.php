<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Note;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function documents(){
        $data['notes']=DB::table('notes')
        ->leftJoin('files', 'notes.id', '=', 'files.document_id')
        ->leftJoin('subjects','notes.subject_id','=','subjects.id')
        ->leftJoin('categories','notes.category_id','=','categories.id')
        ->select('notes.*','files.filename','subjects.name as sname','categories.name as cname')
        ->get();
        return view('documents',$data);
    }

    public function document_preview($slug=null){
        $data['doc']=DB::table('notes')
        ->where('notes.slug',$slug)
        ->leftJoin('files', 'notes.id', '=', 'files.document_id')
        ->leftJoin('subjects','notes.subject_id','=','subjects.id')
        ->leftJoin('categories','notes.category_id','=','categories.id')
        ->select('notes.*','files.filename','subjects.name as sname','categories.name as cname')
        ->first();
        return view('document-preview',$data);
    }
    public function cart()
    {
        return view('cart');
    }
    public function addToCart($id)
    {
        $product = DB::table('notes')
        ->where('notes.id',$id)
        ->leftJoin('files', 'notes.id', '=', 'files.document_id')
        ->select('notes.*','files.filename')
        ->first();
           
        $cart = session()->get('cart', []);
   
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->title,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->filename
            ];
        }
           
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
   
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

      public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
