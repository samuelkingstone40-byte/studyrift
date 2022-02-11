@extends('layouts.admin')
@section('content')
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Documents Sales</h4>
                               
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table table-striped table-sm table-bordered display no-wrap table-users" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date Purchased</th>
                                                <th>OrderID</th>
                                                <th>User</th>
                                                <th>Subject</th>
                                                <th>Category</th>
                                              
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th></th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>No</th>
                                                <th>Date Purchased</th>
                                                <th>OrderID</th>
                                                <th>User</th>
                                                <th>Subject</th>
                                                <th>Category</th>
                                              
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th></th>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(function () {
    
    var table = $('.table-users').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('get_all_sales')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'date', name: 'date'},
            {data: 'orderId', name: 'orderId'},
            {data: 'uname', name: 'uname'},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data: 'amount', name: 'amount'},
            {data: 'status', name: 'status'},
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