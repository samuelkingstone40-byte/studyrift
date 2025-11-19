@extends('layouts.admin')
@section('content')
<div>
    <div class="row g-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <div class="d-inline-flex align-items-center">
                                                <h2 class="text-dark mb-1 font-weight-medium">{{$totalUploads}}</h2>
                                                
                                            </div>
                                            <h3 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Uploads</h3>
                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7"><i data-feather="upload"></i></span>
                                        </div>
                                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-right">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h2 class="text-dark mb-1 font-weight-medium">{{$totalDownloads}}</h2>
                                            <h3 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Downloads</h3>
                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i data-feather="download"></i></span>
                                        </div>
                                    </div>
                                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-right">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                                    class="set-doller">$</sup>{{number_format($withdrawals,2)}}</h2>
                                            <h3 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Month Withdrawal
                                            </h3>
                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                        </div>
                                    </div>
                                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-right">
                                <div class="card-body">
                                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                                        <div>
                                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                                    class="set-doller">$</sup>{{number_format($totalIncome,2)}}</h2>
                                            <h3 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Month Earnings
                                            </h3>
                                        </div>
                                        <div class="ml-auto mt-md-3 mt-lg-0">
                                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                        </div>
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
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <thead>
                                <tr class="">
                                    <th class=" font-14 font-weight-medium text-muted">Subject</th>
                                    <th class=" font-14 font-weight-medium text-muted px-2">Category</th>
                                    <th class=" font-14 font-weight-medium text-muted">Title</th>  
                                    <th class=" font-14 font-weight-medium text-muted">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topDownloads as $top)
                                    <tr>
                                        <td class=" text-muted  font-14">{{$top->sname}}</td>
                                        <td class=" px-2 ">{{$top->cname}}</td>
                                        <td class=" px-2 ">{{\Str::limit($top->title,30)}}</td>
                                        <td class="font-weight-medium text-dark ">${{$top->sum_earning}}</td>
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
