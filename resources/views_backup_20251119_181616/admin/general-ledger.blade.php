@extends('layouts.admin')
@section('content')
<style>
    .table-cell-edit{
    background-color:#f8b600;
    font-weight:800;
    color:#000;
}
</style>
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">General Ledger</h4>
                               
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table table-sm table-striped table-bordered display no-wrap table-gl">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>TransID</th>
                                                <th>Descripion</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Balance</th>
                                                
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>TransID</th>
                                                <th>Descripion</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Balance</th>
                                             
                                               
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
    
    var table = $('.table-gl').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('fetch-general-ledger')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'transdate', name: 'transdate'},
            {data: 'transId', name: 'transId'},
            {data: 'details', name: 'details'},
            {data: 'debit', name: 'debit'},
            {data: 'credit', name: 'credit'},
            {data: 'bal', name: 'bal',"className": "table-cell-edit"},

        
        ]
    })
  })
  </script>
  @endsection