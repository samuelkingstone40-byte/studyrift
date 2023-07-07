@extends('layouts.admin')
@section('content')
<div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">{{$totalUploads}}</h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Uploads</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="upload"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium">{{$totalDownloads}}</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Downloads</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="download"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                            class="set-doller">$</sup>{{number_format($withdrawals,2)}}</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Month Withdrawal
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
   
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                            class="set-doller">$</sup>{{number_format($totalIncome,2)}}</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Month Earnings
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
   
                   
                  
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Top Downloads</h4>
                                    <div class="ml-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                <a class="dropdown-item" href="#">Insert</a>
                                                <a class="dropdown-item" href="#">Update</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0 font-14 font-weight-medium text-muted">File
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Subject
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Category
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Title</th>
                                               
                                                <th class="border-0 font-14 font-weight-medium text-muted">Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($topDownloads as $top)
                                            <tr>
                                                <td class="border-top-0 px-2 py-4">
                                                    <a href="{{url('admin/document-view/'.$top->docId)}}">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="{{route('get-s3-thumbnail',$top->docId)}}"
                                                                alt="thumbnail" class="img-thumbnail" width="60"
                                                                height="60" /></div>
                                                      
                                                    </div>
                                                </a>
                                               
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">{{$top->sname}}</td>
                                                <td class="border-top-0 px-2 py-4">
                                                    {{$top->cname}}
                                                </td>
                                                <td class="border-top-0 px-2 py-4">
                                                    {{\Str::limit($top->title,30)}}
                                                </td>
                                                <td class="font-weight-medium text-dark border-top-0 px-2 py-4">${{$top->sum_earning}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
