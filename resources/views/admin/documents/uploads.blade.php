@extends('layouts.admin')
@section('content')
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href={{ url('admin/dashboard')}}>Home</a></li>
          <li class="breadcrumb-item"><a href="#">Documents</a></li>
          <li class="breadcrumb-item active" aria-current="page">Uploads</li>
        </ol>
    </nav>
    <h3 class="page-header"> documents uploads</h3>
    <div class="">
        <div class="card">
            <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi_col_order"
                            class="table table-striped table-sm table-bordered display no-wrap table-uploads" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Subject</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Uploaded At</th>
                                    <th>Price($)</th>
                                    <th></th>
                                
                                </tr>
                            </thead>
                            <tbody></tbody>
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
            var table = $('.table-uploads').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('fetch_uploads')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                   
                    {data: 'sname', name: 'sname'},
                    {data: 'cname', name: 'cname'},
                    {data: 'title', name: 'title'},
                    {data: 'date', name: 'date'},
                    {data: 'amount', name: 'amount'},
                    {data: 'action', name: 'action',  orderable: true, searchable: true},
                ]
            });
        });
    </script>
@endsection