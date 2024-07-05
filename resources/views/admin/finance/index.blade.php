@extends('layouts.admin')
@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href={{ url('admin/dashboard')}}>Home</a></li>
              <li class="breadcrumb-item"><a href={{route('finance-dashboard')}}>Finance</a></li>
              <li class="breadcrumb-item active" aria-current="page">Index</li>
            </ol>
        </nav>
        <h3 class="page-header"> Finance</h3>
        <div>
            <div class="mb-4">
                <h2>Funds Available</h2>
                <h3>8493</h3>
                <div class="progress" style="height:40px">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 20%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <hr>
            <div class="row g-3">
                <div class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            Total Sales
                            <h2>{{$summary['total_sales']}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            Total Earnings
                            <h2>{{$summary['total_income']}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            Total Payments
                            <h2>{{$summary['total_payouts']}}</h2>
                        </div>
                    </div>
                </div>
            
            </div>

            <?php /* Start of recent sales*/ ?>
            <div>
                <h3>Latest Sales</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi_col_order" class="table table-stripped table-md display no-wrap latest-sales">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Document</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.latest-sales').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('latest-sales')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'name', name: 'name'},
                    {data: 'transactionId', name: 'transactionId'},
                    {data: 'income', name: 'income'},
                ]
            }); 
        });
    </script>
@endsection