@extends('layouts.client')
@section('content')

<style type="text/css">

#show-pdf-button {
	width: 150px;
	display: block;
	margin: 20px auto;
}

#file-to-upload {
	display: none;
}

#pdf-main-container {
	width: 100%;
	margin: 20px auto;
}

#pdf-loader {
	display: none;
	text-align: center;
	color: #999999;
	font-size: 13px;
	line-height: 100px;
	height: 100px;
}

#pdf-contents {
	display: none;
}

#pdf-meta {
	overflow: hidden;
	margin: 0 0 20px 0;
}

#pdf-buttons {
	float: left;
}

#page-count-container {
	float: right;
}

#pdf-current-page {
	display: inline;
}

#pdf-total-pages {
	display: inline;
}

#pdf-canvas {
	border: 1px solid rgba(0,0,0,0.2);
	box-sizing: border-box;
}

#page-loader {
	height: 100px;
	line-height: 100px;
	text-align: center;
	display: none;
	color: #999999;
	font-size: 13px;
}

</style>
<div class="page-wrapper">
    <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                My Uploads
                </h2>

              </div>
               
              
                <div class="col-12 col-md-auto ms-auto d-print-none">
               
                <div class="btn-list">
                 
                  <a href="{{url('upload')}}" class="btn btn-primary d-none d-sm-inline-block" >
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                   Add New Document
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                  </a>
                </div>
              </div>
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
                    <h3 class="card-title">My Files</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                  <div class="">
                  <table class="table card-table table-vcenter text-nowrap datatable yajra-datatable">
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
                    <tbody class="table-tbody">
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
        ajax: "{{route('my-uploads')}}",
        columns: [
            {data: 'image', name: 'image'},
            {data:'date',name:'date'},
            {data: 'sname', name: 'sname'},
            {data: 'cname', name: 'cname'},
            {data: 'title', name: 'title'},
            {data: 'cash', name: 'cash'},
            {data:'earning',name:'earning'},
            {data: 'action', name: 'action',  orderable: true,  searchable: true},
        ]
    });
    
  });
</script>
@endsection