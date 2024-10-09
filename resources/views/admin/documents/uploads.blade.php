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
                ajax: {
                url: "{{ route('fetch_uploads') }}",
                type: 'GET',
                error: function(xhr, status, error) {
                    // Display error in console for debugging
                    console.log('AJAX error: ', xhr);

                    // Optionally alert the error or show in the UI
                    alert('An error occurred while loading the data: ' + xhr);

                    // You can also display the error within the DataTable
                    $('.table-uploads').html('<tr><td colspan="6" class="text-center">Unable to load data</td></tr>');
                }
            },
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