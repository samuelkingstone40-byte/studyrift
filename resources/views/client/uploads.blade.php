@extends('layouts.app')
@section('content')
<section class="section_gap">
 <div class="container py-2">

   
      <h3 class="mb-2">My Upoads</h3>
    
  <div class="row">
    <div class="col-lg-12 mx-auto">
    @if (\Session::has('success'))
          <div class="alert alert-success">
            {!! \Session::get('success') !!}   
           </div>
        @endif


<table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Subject</th>
                <th>Category</th>
                <th>Title</th>
                <th>Price</th>
              
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
    </div>
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
        ajax: "{{route('my-uploads')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data: 'title', name: 'title'},
            {data: 'price', name: 'price'},
           
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