@extends('layouts.admin')
@section('content')
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Withdrawals</h4>
                               
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table table-striped table-sm table-bordered display no-wrap table-users" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                                <th>Date </th>
                                                <th>TransID</th>
                                                <th>User</th>
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
                                                <th>Date</th>
                                                <th>TransID</th>
                                                <th>User</th>
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
        ajax: "{{route('get_all_withdrawals')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'date', name: 'date'},
            {data: 'transId', name: 'transId'},
            {data: 'uname', name: 'uname'},
            {data: 'cash', name: 'cash'},
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