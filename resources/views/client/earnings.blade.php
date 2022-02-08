@extends('layouts.app')
@section('content')
<section class="section_gap">
    <div class="container">
        <h3 class="py-2 font-bold">My Earnings</h3>
        @if (\Session::has('success'))
          <div class="alert alert-success">
            {!! \Session::get('success') !!}   
           </div>
        @endif
       <div class="row">
           <div class="col-md-12 mb-4">
               <div class="card">
                   <div class="card-body">
                       <div class="row">
                       <div class="col-sm-6">
                       <h4>Total Earnings: ${{number_format($total_earnings,2)}}</h4>
                       </div>
                       <div class="col-sm-6 text-right">
                       <h4 class="font-weight text-success">Current Earning: $ {{number_format($current_earnings,2)}} </h4> 
                      <a href="{{route('paypal-payout')}}" class="primary-btn">Withdraw</a>
                           </div>
                  
                     
                           </div>
                   </div>
               </div>
           </div>
      
        <div class="col-md-12">
        <table class="table table-sm table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Date Purchaded</th>
                <th>Order ID</th>
                <th>Subject</th>
                <th>Category</th>
                <th>Title</th>
                <th>Amount($)</th>
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
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'created_at', name: 'created_at'},
            {data: 'orderId', name: 'orderId'},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data: 'title', name: 'title'},
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