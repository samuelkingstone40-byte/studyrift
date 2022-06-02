@extends('layouts.app')
@section('content')
<section class="section_gap">
 <div class="m-4 py-2">

   
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
                <th>File</th>
                <th>Date</th>
                <th>Subject</th>
                <th>Category</th>
                <th>Title</th>
                <th>Price</th>
                <th>Earning/Download</th>
              
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
            {data: 'image', name: 'image'},
            {data:'date',name:'date'},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data: 'title', name: 'title'},
            {data: 'cash', name: 'cash'},
            {data:'earning',name:'earning'},
           
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