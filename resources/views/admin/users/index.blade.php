@extends('layouts.admin')
@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href={{ url('admin/dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
        <h3 class="page-header">Manage Users</h3>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi_col_order" class="table table-striped table-md table-bordered display no-wrap table-users" style="width:100%">
                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Date Created</th>
                                                <th>Status</th>
                                                <th></th>
                                               
                                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date Created</th>
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
                ajax: "{{route('get_all_users')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'date', name: 'date'},
                    {data: 'state', name: 'state'},
                    { data: 'action',  name: 'action',   orderable: true,   searchable: true },
                ]
            });
            
        });
    </script>
@endsection