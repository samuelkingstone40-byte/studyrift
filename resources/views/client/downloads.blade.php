
@extends('layouts.client_layout')
<title>Downloads - Studymerit </title>
@section('content')

<section class="mt-10">
  <div class="text-3xl font-bold">
    My Downloads
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
                     Category
                   </th>
                  <th scope="col" class="px-6 py-3">
                    Subject
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Transaction Ref
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Amount
                  </th>
                  
                <th scope="col" class="px-6 py-3">
                  Action
              </th>
              </tr>
          </thead>
          <tbody class="table-tbody">
              
            @foreach ($downloads as $item )
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
                {{$item->transactionId}}
              </td>
              <td class="px-6 py-4">
                {{$item->price}}
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

</section>





@endsection
@section('scripts')
<script type="text/javascript">
  $(function () {
    
    var table = $('.downloads-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('fetch-downloads')}}",
        columns: [
            {data: 'image', name: 'image'},
            {data: 'date', name: 'date'},
            {data: 'orderId', name: 'orderId'},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data: 'price', name: 'price'},
         
           
            {
                data: 'action', 
                name: 'action', 
                
            },
        ]
       
    });
    
  });
</script>
@endsection