
@extends('layouts.client')
<title>Downloads - Studymerit </title>
@section('content')

<div class="page-wrapper">
    <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
              <div class="col">
               
                <h2 class="page-title">
                My Downloads
                </h2>
              </div>
              <!-- Page title actions -->
             
            </div>
          </div>
    </div>

    <div class="page-body">
      <div class="container-xl">
        <div class="row row-deck row-cards">
          <div class="col-lg-12">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Documents</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable  downloads-datatable">
                      <thead>
                        <tr>
                          <th>Invoice Subject</th>
                          <th>Client</th>
                          <th>VAT No.</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Price</th>
                          <th>Download</th>
                          
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
    
    var table = $('.downloads-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('fetch-downloads')}}",
        columns: [
            {data: 'image', name: 'image'},
            {data: 'date', name: 'date'},
            {data: 'orderId', name: 'orderId'},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data: 'price', name: 'price'},
         
           
            {
                data: 'action', 
                name: 'action', 
                
            },
        ]
       
    });
    
  });
</script>
@endsection