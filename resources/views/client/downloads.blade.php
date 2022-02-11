@extends('layouts.app')
@section('content')
<section class="section_gap">
    <div class="container">
        <h3 class="mb-4">My Downloads</h3>

        <div>
        <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>File</th>
                <th>Date Purchased</th>
                <th>OrderId</th>
                <th>Subject</th>
                <th>Category</th>
                <th>Title</th>
               
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('fetch-downloads')}}",
        columns: [
            {data: 'image', name: 'image'},
            {data: 'date', name: 'date'},
            {data: 'orderId', name: 'orderId'},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data: 'title', name: 'title'},
         
           
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