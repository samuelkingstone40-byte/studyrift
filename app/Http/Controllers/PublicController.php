<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;
use Response;

class PublicController extends Controller
{
    public function index(){
        $data['uploads']=$this->popular_downloads();
        $data['categories']=$this->getFilteredCategories();
        return view('welcome',$data);
    }

    public function popular_downloads(){
        $downloads=DB::table('orders')
        ->whereNull('documents.status')
        ->leftJoin('documents','documents.id','=','orders.docId')
        ->leftJoin('subjects','subjects.id','=','documents.subject_id')
        ->groupBy('orders.docId','orders.earning','subjects.name','documents.title','documents.price','documents.slug')
        ->orderBy(DB::raw('COUNT(orders.earning)'), 'desc')
        ->select('documents.title','documents.slug','documents.price','orders.docId','subjects.name as sname',
         DB::raw("COUNT(orders.docId) as count_click"),DB::raw("sum(orders.earning) as sum_earning"))
         ->limit(4)
        ->get();

        return $downloads;
    }

    public  function buildSQLQueryFromFilter($request)
    {
        $queryStr = "";
        $sqlQuery = [];
        $currentIndex = 1;
       
        $subject = isset($request->subject) ? trim($request->subject) : null;
        $category = isset($request->category) ? trim($request->category) : null;
        $search = isset($request->search) ? trim($request->search) : null;
       

        // $ cannot be used to parse params on query

        if ($search != null) {
            $queryStr .= " AND (n.title LIKE :p$currentIndex  OR c.description LIKE :p$currentIndex )";
            $sqlQuery['p' . $currentIndex] = '%' . $search . '%';
            $sqlQuery['query_str'] = $queryStr;
            $currentIndex++;
        }

        if ($category != null) {
            $queryStr .= " AND (n.category_id = :p$currentIndex)";
            $sqlQuery['p' . $currentIndex] =  $category;
            $sqlQuery['query_str'] = $queryStr;
            $currentIndex++;
        }

        if ($subject != null) {
            $queryStr .= " AND (n.category_id = :p$currentIndex)";
            $sqlQuery['p' . $currentIndex] =  $subject;
            $sqlQuery['query_str'] = $queryStr;
            $currentIndex++;
        }
        $sqlQuery['current_index'] = $currentIndex;
        return $sqlQuery;
    }

    public function documents(Request $request){
        $search_text=strip_tags($request->get('search_text'));
        $category=$request->get('category');
        $notes =DB::table('documents');

        if($search_text){
            $notes->where('documents.title','like','%'.$search_text.'%');
        }
        if($category){
            $notes->where('documents.category_id','=',$category);
        }
        $notes=$notes->
        leftJoin('files', 'documents.id', '=', 'files.document_id')
            ->leftJoin('subjects','documents.subject_id','=','subjects.id')
            ->leftJoin('categories','documents.category_id','=','categories.id')
            ->join('users','users.id','=','documents.user_id')
            ->where('users.status','=',1)
            ->whereNull('documents.status')
            ->select('documents.id','documents.title','documents.description','documents.slug','documents.price','files.filename','subjects.name as subject','categories.name as category')
            ->orderBy('documents.id','desc')
            ->paginate(10);
        
        $data['subjects']=$this->getSubjects();
        $data['categories']=$this->getCategories();
        $data['notes']=$notes;
        return view('documents',$data);   
       
    }

    public function getSubjects(){
        return DB::table('subjects')->orderBy('name','desc')->get();
    }

    public function getCategories(){
        return DB::table('categories')->orderBy('name','desc')->get();
    }

    public function getFilteredCategories(){
        $categories =DB::table('categories')->orderBy('name','desc')
        ->get()
        ->reject(function ($category) {
            return in_array($category->name, ['VATI-RN', 'VATI-PN','RN Comprehensive Predictor','NECLEX-PN','NCLEX-RN','NCLEX',
        'HESI EXIT RN EXAM','HESI','Ati pediatrics proctored','ATI MEDICAL SURGICAL']); // Categories to exclude
        })
        ->values();

        return $categories;
    }

    public function document_preview($slug=null){
        $file=DB::table('documents')
       
        ->leftJoin('files', 'documents.id', '=', 'files.document_id')
        ->leftJoin('subjects','documents.subject_id','=','subjects.id')
        ->leftJoin('categories','documents.category_id','=','categories.id')
        ->join('users','users.id','=','documents.user_id')
        ->where([['documents.slug','=',$slug],['users.status','=',1]])
        ->whereNull('documents.status')
        ->select('documents.*','files.filename','subjects.name as sname','categories.name as cname')
        ->first();

        if(!$file){
            abort(404);
        }
        $data['doc']=$file;
        $seller_id=$file->user_id;
        $seller_info=DB::table('users')
            ->where('id',$seller_id)
            ->select('name')->first();
        $seller_uploads=DB::table('documents')->where('user_id',$seller_id)->count();
        $downloads=DB::table('orders')->where(['owner_id'=>$seller_id])->count();
       
        $data['reviews']=$this->get_reviews($file->id);
        $title=$file->title;
        $data['recommends']=$this->get_related($title);
        $data['uploads']=$seller_uploads;
        $data['downloads']=$downloads;
        $data['seller']=$seller_info;

        if(Auth::user()){
            $data['purchased']=$this->check_if_purchased($file->id);

        }
        return view('document-preview',$data);
    }

    public function get_reviews($id){
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

    public function get_related($title)
    {
        $notes =DB::table('documents')
        ->whereNull('documents.status')
        ->where('title', 'Like', '%' . $title. '%')
        ->leftJoin('files', 'documents.id', '=', 'files.document_id')
        ->leftJoin('subjects','documents.subject_id','=','subjects.id')
        ->leftJoin('categories','documents.category_id','=','categories.id')
        ->select('documents.*','files.filename','subjects.name as sname','categories.name as cname')
        ->get();

        return $notes;
        
    }
    public function cart()
    {
        return view('cart');
    }

    public function checkout(){
        
        if(Auth::user()){
          $user=Auth::user();
        }else{
            $user='';
        }
        return view('checkout')->with(compact('user'));
    }

    public function addToCart($id)
    {
        $product = DB::table('documents as d')
        ->where('d.id',$id)
        ->leftJoin('files as f', 'd.id', '=', 'f.document_id')
        ->select('d.*','f.filename')
        ->first();

        //get file uploaded path

        $document_id=$product->id;
        $file=DB::table('files')
            ->where('document_id',$document_id)
            ->select('filename')
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

    public function remove(Request $request){
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contacts');
    }

    public function termsofservice(){
        return view('term-of-service');
    }

    public function privacy(){
        return view('privacy');
    }

    public function download_file($filename){
        //$filepath = public_path('files/'.$filename);
        $attachment = 'files/'.$filename;
        $headers = [
            'Content-Type'        => 'application/jpeg',
            'Content-Disposition' => 'attachment; filename="'. $attachment .'"',
        ];
 
        return Response::make(Storage::get($attachment), 200, $headers);
    }

    public function paginationFilter($request)
    {
        $queryStr = "";
        $pageQuery = [];
        $pagination = [];
        $get = $request;
        $per = isset($get['per']) ? intval(trim($get['per'])) : null;
        $page = isset($get['page']) ? intval(trim($get['page'])) : null;

        if ($per == null) {
            $per = 10;
        }

        if ($page == null) {
            $page = 1;
        }

        if (!is_int($per) || !is_int($page)) {
            $pageQuery['status'] = 400;
            $pageQuery['message'] = 'per and page values must be digits';
            return $pageQuery;
        }

        $pagination['page'] = $page;
        $pagination['per'] = $per;

        $page = ($page - 1) * $per;
        $queryStr .= " LIMIT $per OFFSET $page ";

        $pageQuery['status'] = 200;
        $pageQuery['pagination'] = $pagination;
        $pageQuery['query_str'] = $queryStr;
        $pageQuery['message'] = 'success';

        return $pageQuery;
    }

    /**
     * return file from s3 bucket
     * @param $file_path
     */

    public function get_s3_bucket_file($filepath){
        //check if exist

        $file=DB::table('files')->where('filename',$filepath)->first();

        //check if document exists
        if(!$file){
            return abort(404);
        }

        $document=DB::table('documents')->where('id',$file->document_id);

        if(!$document){
            return abort(404);
        }
        return Storage::get('files/'.$filepath);
    }

    public function get_s3_thumbnail($id){
        try {
           return Storage::get('documents-thumbnails/thumbnail-'.$id);
        } catch (\Throwable $th) {
            return null;
        }
   
    }

    public function update_notes_table(){
        

       $path= "https://studymerit.s3.amazonaws.com/documents/1687387642_CUPS+Printer+Driver.pdf";

       return Storage::get('documents/1687390644_1687199849_20230427094221_644a437de6e05_karen_floyd_abdominal_pain_1___1_(1).pdf');
                   
    }

    public function search_files(Request $request){
   
        if($request->ajax()){
            $output='';
            $search_text = $request->input('search');
            $files =DB::table('documents')
                ->where('title','like','%'.$search_text.'%')
                ->select(['id','title','slug'])
                ->get();

            if($files->count()>0){
                foreach($files as $file){
                    $output .='
                    <li class="block break-words border-b px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <a href="/document-preview/'.$file->slug.'" class="block break-words">
                        '.htmlspecialchars($file->title).'
                    </a>
                ';

                }
                return response($output);
            }else{
                return response('<li class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">No documents found</li>');
            }
        

        }
    }   
}
