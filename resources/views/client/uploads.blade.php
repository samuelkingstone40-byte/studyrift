<title>Uploads - Studymerit</title>
@extends('layouts.client_layout')
@section('content')

<style type="text/css">

#show-pdf-button {
	width: 150px;
	display: block;
	margin: 20px auto;
}

#file-to-upload {
	display: none;
}

#pdf-main-container {
	width: 100%;
	margin: 20px auto;
}

#pdf-loader {
	display: none;
	text-align: center;
	color: #999999;
	font-size: 13px;
	line-height: 100px;
	height: 100px;
}

#pdf-contents {
	display: none;
}

#pdf-meta {
	overflow: hidden;
	margin: 0 0 20px 0;
}

#pdf-buttons {
	float: left;
}

#page-count-container {
	float: right;
}

#pdf-current-page {
	display: inline;
}

#pdf-total-pages {
	display: inline;
}

#pdf-canvas {
	border: 1px solid rgba(0,0,0,0.2);
	box-sizing: border-box;
}

#page-loader {
	height: 100px;
	line-height: 100px;
	text-align: center;
	display: none;
	color: #999999;
	font-size: 13px;
}

</style>
<div class="mt-10">
  <div class="flex justify-between">
    <div class="text-2xl font-semibold my-2">My Documents</div>
    <div>
      <a href="{{url('upload')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:px-2 sm:py-1 lg:px-4 md:py-2 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-8 h-8 text-white  pr-2 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        Add New Document
      </a>
     </div>
  </div>

  <div class="mt-6 bg-white">
    <div class=" border relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full py-2 text-sm text-left text-gray-500  dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  
                  <th scope="col" class="px-6 py-3">
                      Date
                  </th>
                 
                  <th scope="col" class="px-6 py-3">
                    Subject
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Category
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Title
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Price
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Earnings
                </th>
               
                <th scope="col" class="px-6 py-3">
                  Actions
              </th>
              </tr>
          </thead>
          <tbody class="table-tbody">
              @foreach ($documents as $item )
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              
                <td class="px-6 py-4">
                  {{$item->created_at}}
                </td>
                <td class="px-6 py-4">
                  {{$item->cname}}
                </td>
                <td class="px-6 py-4">
                 {{$item->sname}}
                </td>
                <td class="px-6 py-4">
                  {{$item->title}}
                </td>
                <td class="px-6 py-4">
                  {{$item->price}}
                </td>
               
                <td class="px-6 py-4">
                 {{number_format($item->price*0.7,2)}}
                </td>
                <td class="px-6 py-4">
                 <a href="{{url('view-document/'.$item->slug)}}"  class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">View</a>
                </td>

              </tr>
                
              @endforeach
              
          </tbody>
      </table>
      <nav class="flex items-center justify-between p-4" aria-label="Table navigation">
          <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span class="font-semibold text-gray-900 dark:text-white">1-10</span> of <span class="font-semibold text-gray-900 dark:text-white">1000</span></span>
          <ul class="inline-flex -space-x-px text-sm h-8">
              <li>
                  <a href="#" class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
              </li>
              <li>
                  <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
              </li>
              <li>
                  <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
              </li>
              <li>
                  <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
              </li>
              <li>
                  <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
              </li>
              <li>
                  <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
              </li>
              <li>
                  <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
              </li>
          </ul>
      </nav>
    </div>


  </div>

</div>



@endsection
@section('scripts')
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        order:[0,"desc"],
        ajax: "{{route('my-uploads')}}",
        columns: [
           
            {data:'date',name:'date',orderable: true},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data: 'title', name: 'title'},
            {data: 'cash', name: 'cash'},
            {data:'earning',name:'earning'},
            {data: 'action', name: 'action'},
        ]
    });
    
  });
</script>
@endsection