@extends('layouts.client_layout')

@section('content')
        <div class=" mt-10">
          <!-- Summary -->
          <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
              <div class="border bg-white rounded border-gray-300 mb-1 py-2 content-center flex flex-col items-center ">
                <svg class="w-12 h-12 text-orange-400  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                  <path  d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z"/>
                </svg>
                 <h3 class="text-xl font-bold my-2">{{$count_uploads}}</h3>
              </div>
              <div class="border text-gray-500 bg-white  border-gray-300 mb-1 py-1 text-lg font-bold text-center ">
                Uploads
              </div>
            </div>
         
            <div>
              <div class="border rounded bg-white border-gray-300 mb-1 py-2 content-center flex flex-col items-center">
                <svg class="w-12 h-12 text-blue-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 8v4m0 0-2-2m2 2 2-2M3 5v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5H3ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z"/>
                </svg>  
                
                 <h3 class="text-xl font-bold my-2">{{$count_downloads}}</h3>
              </div>
              <div class="border text-gray-500 bg-white border-gray-300 mb-1 py-1 text-lg font-bold text-center ">
                Downloads
              </div>
            </div>

            <div>
              <div class="border rounded bg-white border-gray-300 mb-1 py-2 content-center flex flex-col items-center ">
                <svg class="w-12 h-12 text-green-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                </svg>
                 <h3 class="text-xl font-bold my-2">$ {{number_format($earnings,2)}}</h3>
              </div>
              <div class="border text-gray-500  bg-white border-gray-300 mb-1 py-1 text-lg font-bold text-center ">
                Total Earnings
              </div>
            </div>
         
          </div>

          <!-- Content -->
          <div class="grid-container grid grid-cols-5 gap-4">
            <div class="item1 col-span-3">
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
                                Title
                              </th>
                             
                              
                            <th scope="col" class="px-6 py-3">
                              
                          </th>
                          </tr>
                      </thead>
                      <tbody class="table-tbody">
                        @foreach ($downloads as $doc)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                          <td class="px-6 py-4">
                            {{$doc->name}}
                          </td>
                          <td class="px-6 py-4">
                            <div class="text-truncate">
                              {{$doc->title}}
                            </div>
                          </td>
                          <td class="px-6 py-4">
                          {{\Carbon\Carbon::create($doc->created_at)->toFormattedDateString()}}
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
            <div class="item2 col-span-2">
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
                                Amount
                              </th>
                             
                              
                            <th scope="col" class="px-6 py-3">
                              
                          </th>
                          </tr>
                      </thead>
                      <tbody class="table-tbody">
                        @foreach ($sales as $sale )
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                          <td class="px-6 py-4">
                            {{\Carbon\Carbon::create($sale->created_at)->toFormattedDateString()}}
                          </td>
                          <td class="px-6 py-4">
                            <div class="text-truncate">
                              {{$sale->name}}
                            </div>
                          </td>
                          <td class="px-6 py-4">
                            {{$sale->earning}}
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
          </div>

      
          
      
        </div>
       




@endsection
