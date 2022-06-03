<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['count_uploads']=DB::table('notes')
        ->where('user_id',Auth::id())
        ->whereNull('notes.status')
        ->count();
        $data['count_downloads']=DB::table('orders')->where('user_id',Auth::id())->count();
        $data['earnings']=DB::table('orders')
        ->where('owner_id',Auth::id())
        ->where('status','COMPLETED')
        ->sum('earning');
        $data['downloads']=$this->recent_dowloads();
        $data['sales']=$this->recent_sales();
        return view('home',$data);
    }

    public function recent_dowloads(){
        $documents=DB::table('orders')
        ->leftJoin('notes','notes.id','=','orders.docId')
        ->leftJoin('subjects','subjects.id','=','notes.subject_id')
        ->where('orders.user_id',Auth::user()->id)
        ->orderBy('orders.id')
        ->select('notes.id','notes.subject_id','notes.price','notes.title','orders.created_at','subjects.name')
        ->get();

        return $documents;
    }

    public function recent_sales(){
        $documents=DB::table('orders')
        ->leftJoin('notes','notes.id','=','orders.docId')
        ->leftJoin('subjects','subjects.id','=','notes.subject_id')
        ->where('orders.owner_id',Auth::user()->id)
        ->orderBy('orders.id')
        ->select('notes.id','notes.subject_id','notes.price','orders.orderId','orders.created_at','orders.earning','subjects.name')
        ->get();

        return $documents;
    }
    
}
