@extends('layouts.client')
<title>Earnings - Studymerit </title>
@section('content')

<div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                My Account
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
           <div class="row row-cards">
            
           <div class="col-md-6 col-xl-4">
                <div class="card card-sm mb-2">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                         <h2> ${{number_format($total_earnings,2)}} </h2>
                        </div>
                        <div class="text-muted">
                          <h4>Total Earnings</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card card-sm py-2">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="19" r="2" /><circle cx="17" cy="19" r="2" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          <h2>${{number_format($current_earnings,2)}}</h2>
                        </div>
                        <div class="text-muted">
                          <h4>Available Earning</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-8">
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Transactions</h3>
                  </div>
                  <div class="card-body">
               <div class="card-table table-responsive">
               <table class="table table-bordered table-sm  yajra-datatable">
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
          </div>
        </div>
</div>
        </div>
</div>

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