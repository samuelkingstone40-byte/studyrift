
@extends('layouts.admin')
@section('content')
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Transactions</h4>
                               
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table table-sm table-striped table-bordered display no-wrap table-users" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>TransID</th>
                                                <th>User</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                
                                               
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
                                                <th>Detail</th>
                                                <th>Amount</th>
                                             
                                               
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
        ajax: "{{route('get_all_transactions')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'date', name: 'date'},
            {data: 'transId', name: 'transId'},
            {data: 'uname', name: 'uname'},
            {data: 'details', name: 'details'},

            {data: 'cash', name: 'cash'},

        
        ]
       
    });
    
  });
</script>
@endsection