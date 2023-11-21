@extends('layouts.default')
<title>Buy-Studymerit </title>
<link rel="stylesheet" href="{{asset('theme/css/documents.css')}}">
@section('content')

<section  class="mt-20 h-auto overflow-hidden bg-gray-50 md:pt-0 sm:pt-16 2xl:pt-16">
<div class="px-6 mx-1 md:mx-auto   max-w-screen-xl">
    <div class="md:flex md:gap-5">
        <div class="mb-3 md:basis-1/4 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-800">
            <div class="h-auto px-3 py-4 overflow-y-auto">
                <h1>Search Materials</h1>
                <div>
                    <form action="{{route('search')}}" method="get">
                        @csrf
                        <div>
                            <div class="mb-4">
                                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a subject</option>
                                    @foreach ($subjects as $subject)
                                      <option value="{{$subject->id}}">{{$subject->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">

                                <select id="categories" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="block">
                                <button type="submit" class="text-white w-full bg-[#FF9119] justify-between hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40 me-2 mb-2">
                                    Search
                                    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                      </svg>
                                    </button>
                            </div>

                           
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
        <div class="md:basis-3/4">
        <div>
            @if(count($notes)>0)
            @foreach($notes as $index => $note)
                <a  href="{{url('document-preview/'.$note->slug)}}">
                <div class="p-4 md:flex gap-5 mb-4 border bg-white border-b-gray-300 rounded">
                    <div class=" m-2  rounded">    
                        <img src="{{route('get-s3-thumbnail',$note->id)}}" class="w-32 h-32" alt="{{route('get-s3-thumbnail',$note->id)}}"/> 
                    </div>
                    <div class="">
                        <h1 class="text-sm md:text-xl font-semibold py-2">{{$note->title}}</h1>
                        <h4 class="text-lg pb-2 text-gray-400">{{$note->subject}} / {{$note->category}}</h4>
                        <p class="text-sm line-clamp-1">
                         {{$note->description}}
                       </p>
                       <h2 class="text-xl text-green-500 my-4  font-bold">${{number_format($note->price,2)}}</h2><span class="strike-text"></span>

                  
                  
                    </div>
                </div>
                </a>
                @endforeach
                <nav class="blog-pagination justify-content-center d-flex">
                    <ul class="pagination">
                        
                        {{$notes->links('pagination::simple-tailwind')}}
                        
                    </ul>
                </nav>
                @else
                  <div class="card">
                      <div class="card-body text-center">
                          <img src="{{asset('theme/img/no-results.png')}}" width="80px" alt="">
                           <h5>Oops! We couldn’t find results for your search:</h5>
                          <h4 class="card-title">No document found</h4>
                          <a href="{{route('search')}}" class="genric-btn btn primary radius">Browse</a>
                      </div>
                  </div>
                
                @endif


        </div>
        </div>
       
      </div>
</div>
</section>

{{-- <section class="">

    <div class="">
        <div class="row">
            <div class="col-sm-12">
                
                <form action="{{route('search')}}" method="get">
               <div class="search-box">
               <div class="search">
                      <i class="fa fa-search"></i>
                      <input type="text" class="form-control"  id="search_input"
                name="search_text" placeholder="title, description, courses....">
                      <button type="submit" class="btn2">Search</button>
                </div>
               </div>
             
             
            </form>
             
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 my-2">
                   
             
                <div class="card">
                    <form action="{{route('search')}}" method="get">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Filter</h4>
                        
                        <div class="form-group">
                            <label for="">Subject</label>
                            <select name="subject" id="" class="form-control">
                                <option Selected>Choose...</option>
                                @foreach ($subjects as $subject)
                                 <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category" id="" class="form-control">
                                <option selected>Choose...</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="primary-btn">Search</button>
                    </div>
                    </form>
                </div>
             
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

           
    <div class="d-flex justify-content-center row mx-1 ">
        <div class="col-md-12">
        @if(count($notes)>0)
        @foreach($notes as $index => $note)
        
            <div class="row p-2 mb-3 border rounded list-content">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-1">  
                    
        
                <img src="{{route('get-s3-thumbnail',$note->id)}}" width="250" alt="{{route('get-s3-thumbnail',$note->id)}}"/>
              
                      
                </div>
                <div class="col-md-6 py-4">
                    <h4>{{$note->subject}} / {{$note->category}}</h4>
                    <h5 class="font-bold py-2">{{$note->title}}</h5>
                   
                   
                    <p class="text-justify text-truncate para ">
                    {{$note->description}}
                   </p>
                    <h5 class="numPages" id="{{$note->slug}}"></h5>
                </div>
                <div class="col-md-3 border-left mt-1">
                    <div class="text-center py-4">
                       <h4>{{$note->subject}} / {{$note->category}}</h4>
                       
                        <h2 class="mr-1 text-success">${{number_format($note->price,2)}}</h2><span class="strike-text"></span>
                    
                        <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                    </div>
                  
                    <div class="text-center">
                        <a href="{{url('document-preview/'.$note->slug)}}" class="btn btn-view" >View</a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
              <div class="card">
                  <div class="card-body text-center">
                      <img src="{{asset('theme/img/no-results.png')}}" width="80px" alt="">
                       <h5>Oops! We couldn’t find results for your search:</h5>
                      <h4 class="card-title">No document found</h4>
                      <a href="{{route('search')}}" class="genric-btn btn primary radius">Browse</a>
                  </div>
              </div>
            
            @endif
            
        </div>
        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                
                                {{$notes->links('pagination::simple-tailwind')}}
                                
                            </ul>
                        </nav>
    </div>
    
</div>

            
        </div>
    </div>
</section> --}}
@endsection

