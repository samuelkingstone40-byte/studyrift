@extends('layouts.admin')
@section('content')
    <div>
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href={{ url('admin/dashboard')}}>Home</a></li>
              <li class="breadcrumb-item"><a href={{ url('admin/users')}}>Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
        <div class="row g-3">
            <div class="col-sm-12">
                <h3 class="page-header">{{$user->name}}</h3>
                <div class="row ">
                    <div class="col-lg-4 col-sm-12" >
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <h2 class="font-weight-bold" style="color:#000">Total Uploads</h2>
                                    <h2 style="color:chocolate">{{$total_uploads}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <h2 class="font-weight-bold" style="color:#000">Total Downloads</h2>
                                    <h2 class="text-primary">{{$total_downloads}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <h2 class="font-weight-bold" style="color:#000">Total Earnings</h2>
                                    <h2 class="text-success"> ${{$total_earnings}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-sm-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Documents Uploaded </button>
                      <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Files Downloaded</button>
                      <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Transactions Records</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                   <table id="multi_col_order"
                                    class="table table-sm table-striped table-bordered display no-wrap table-uploads" style="width:100%">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                            <th>Date</th>
                                            <th>Subject</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Price($)</th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>No</th>
                                            <th>Date</th>
                                            <th>Subject</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Price($)</th>
                                            <th></th>
                                           
                                        </tr>
                                    </tfoot>
                                   </table>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                    class="table table-sm table-striped table-bordered display no-wrap table-downloads" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>OrderId</th>
                                                <th>Subject</th>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th></th>
            
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>No</th>
                                                <th>Date</th>
                                                <th>OrderId</th>
                                                <th>Subject</th>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th></th>
            
                                            
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                   <table id="multi_col_order"
                                    class="table table-sm table-striped table-bordered display no-wrap table-trans" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>TransID</th>
                                            <th>User</th>
                                            <th>Type</th>
                                            <th>Amount($)</th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>No</th>
                                            <th>Date</th>
                                            <th>TransID</th>
                                            <th>User</th>
                                            <th>Type</th>
                                            <th>Amount($)</th>
                                            <th></th>
                                           
                                        </tr>
                                    </tfoot>
                                   </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="" id="user_id" value="{{$user->id}}">
    </div>
      
    

@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            var user_id=$('#user_id').val();
            var table_uploads = $('.table-uploads').DataTable({  
                processing: true,
                serverSide: true,
                ajax: "{{url('admin/user-uploads')}}/"+ user_id,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'date', name: 'date'},
                    {data: 'sname', name: 'sname'},
                    {data: 'cname', name: 'cname'},
                    {data: 'title', name: 'title'},
                    {data: 'price', name: 'price'},
                    {data: 'action',  name: 'action',   orderable: true,   searchable: true },
                ]
            });

            var table_downloads = $('.table-downloads').DataTable({  
                processing: true,
                serverSide: true,
                ajax: "{{url('admin/user-downloads')}}/"+ user_id,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'orderId', name: 'orderId'},
                    {data: 'sname', name: 'sname'},
                    {data: 'cname', name: 'cname'},
                    {data: 'title', name: 'title'},
                    {data: 'action',  name: 'action',   orderable: true,   searchable: true },
                ]
            });

            var table_trans = $('.table-trans').DataTable({  
                processing: true,
                serverSide: true,
                ajax: "{{url('admin/user-transactions')}}/"+ user_id,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'date', name: 'date'},
                    {data: 'transId', name: 'transId'},
                    {data: 'uname', name: 'uname'},
                    {data: 'type', name: 'type'},

                    {data: 'amount', name: 'amount'},

                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: true, 
                        searchable: true
                    },
                ]
            });

            $('#myTab button').on('click', function (event) {
                event.preventDefault()
                $(this).tab('show')
            })
            
        });
    </script>
@endsection