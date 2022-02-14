@extends('layouts.admin')
@section('content')
 <div class="row">
         <div class="col-sm-12">
         <div class="card">
                            <div class="card-body">
                            <input type="hidden" name="" id="user_id" value="{{$user->id}}">
                                <h3 class="card-title mb-3">Account Activity</h3>

                                <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                        <a href="#profile-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#uploads-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Uploads</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#downloads-b1" data-toggle="tab" aria-expanded="true"
                                            class="nav-link ">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Downloads</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#trans-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Transaction</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane show active" id="profile-b1">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <div class="profile-pic mb-3 mt-3">
                                                            <img src="../assets/images/users/5.jpg" width="150" class="rounded-circle" alt="user" />
                                                            <h4 class="mt-3 mb-0">{{$user->name}}</h4>
                                                            <a href="mailto:danielkristeen@gmail.com">{{$user->email}}</a>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" name="" value="{{$user->name}}" class="form-control" id="">
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text" name="" value="{{$user->email}}" class="form-control" id="">
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="">Paypal Email</label>
                                                    <input type="text" name="" value="{{$user->paypalEmail}}" class="form-control" id="">
                                                </div>
                                          
                                            </div>
                                        </div>
                                 
                    
                        
                     
                           </div>
                                   
                                    <div class="tab-pane " id="uploads-b1">
                                    <div class="table-responsive">
                                        <h4 class="py-2">Uploads</h4>
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
                                    <div class="tab-pane" id="downloads-b1">
                                    <div class="table-responsive">
                                        <h4 class="py-2">Downloads</h4>
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
                             <div class="tab-pane" id="trans-b1">
                                    <div class="table-responsive">
                                        <h4 class="py-2">Transactions</h4>
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

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
         </div>
     </div>
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
    
  });
</script>
@endsection