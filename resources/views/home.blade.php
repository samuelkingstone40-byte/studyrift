@extends('layouts.client')

@section('content')


        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Dashboard
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                 
                  <a href="{{url('upload')}}" class="btn btn-primary d-none d-sm-inline-block" >
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                   Add New Document
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
       



<div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
             <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <h4>My Total Uploads</h4>
                            </div>
                            <div class="text-muted">
                             <h2>{{$count_uploads}}</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="26" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="19" r="2" /><circle cx="17" cy="19" r="2" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <h4>Total Downlaods</h4>
                            </div>
                            <div class="text-muted">
							                 <h2>{{$count_downloads}}</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                          <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="26" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                             <h4>Total Earning</h4>
                            </div>
                            <div class="text-muted">
					                    	<h2>$ {{number_format($earnings,2)}}</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-8">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Recent Downloads</h3>
                    <div class="card-table table-responsive">
                    <table class="table table-vcenter ">
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th>Title</th>
                          <th>Date</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @foreach ($downloads as $doc)
                        <tr>
                          <td class="w-1">
                            {{$doc->name}}
                          </td>
                          <td class="td-truncate">
                            <div class="text-truncate">
                              {{$doc->title}}
                            </div>
                          </td>
                          <td class="text-nowrap text-muted">
                          {{\Carbon\Carbon::create($doc->created_at)->toFormattedDateString()}}
                          </td>
                        </tr>
                        @endforeach
                       
                        
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Latest Sales</h3>
                    <div class="card-table table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Subject</th>
                          <th>Earning</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($sales as $sale )
                        <tr>
                          <td>{{\Carbon\Carbon::create($sale->created_at)->toFormattedDateString()}}</td>
                          <td>{{$sale->name}}</td>
                          <td>${{$sale->earning}}</td> 
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
@endsection
