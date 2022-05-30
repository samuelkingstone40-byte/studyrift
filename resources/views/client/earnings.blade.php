@extends('layouts.client')
@section('content')
<section class="section_gap">
    <div class="cont m-4">
        <h3 class="py-2 font-bold">My Earnings</h3>
        @if (\Session::has('success'))
          <div class="alert alert-success">
            {!! \Session::get('success') !!}   
           </div>
        @endif
       <div class="row">
       <div class="col-sm-4 right-contents py-1 mb-2">
<ul>
<li>
<a class="justify-content-between d-flex" href="#">
<p>Total Earnings</p>
<span class="or">${{number_format($total_earnings,2)}}</span>
</a>
</li>
<li>
<a class="justify-content-between d-flex" href="#">
<p>Available </p>
<span class="or"><b>${{number_format($current_earnings,2)}}</b></span>
</a>
</li>

</ul>


</div>

        <div class="col-sm-8">
        <table class="table table-sm table-bordered yajra-datatable">
        <thead>
            <tr>
               
                <th>Date</th>
                <th>Order ID</th>
                <th>Subject</th>
                <th>Category</th>
                <th>Earning</th>
                <th>Status</th>

                
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
        ajax: "{{route('fetch-earnings')}}",
        columns: [
            
            {data: 'date', name: 'date'},
            {data: 'orderId', name: 'orderId'},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data:'earning',name:'earning'},
           
         
           
            {
                data: 'status', 
                name: 'status', 
                orderable: true, 
                searchable: true
            },
        ]
       
    });
    
  });
</script>
@endsection