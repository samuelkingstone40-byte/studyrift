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
        $data['count_uploads']=DB::table('notes')->where('user_id',Auth::id())->count();
        $data['count_downloads']=DB::table('orders')->where('user_id',Auth::id())->count();
        $data['earnings']=DB::table('orders')
        ->where('owner_id',Auth::id())
        ->where('status','COMPLETED')
        ->sum('earning');
        return view('home',$data);
    }
}
