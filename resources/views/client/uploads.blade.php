@extends('layouts.app')
@section('content')
<section class="section_gap">
<div class="container ">
<div class="row  mb-1">
    <div class="col-lg-12 mx-auto">
      <h1 class="">UPLOADS</h1>
     
    </div>
  </div>
  <!-- End -->

  <div class="row">
    <div class="col-lg-12 mx-auto">
    @if (session('status'))
<div class="alert alert-success" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('failed') }}
</div>
@endif
      <!-- List group-->
      <ul class="list-group shadow">

        <!-- list group item-->
        @foreach($notes as $note)
        <li class="list-group-item mb-3">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3">
          <embed name="plugin" src="{{url('files/'.$note->filename)}}/{{ Storage::disk('local')->url('files/'.$note->filename)}}" type="application/pdf">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold mb-2">{{$note->title}}</h5>
              <h4>{{$note->sname}} / {{$note->cname}}</h4>
              <p class="font-naormal text-muted mb-0 medium">{{$note->description}}</p>
             
              <div class="d-flex align-items-center justify-content-between mt-1">
                <h4 class="font-weight-bold my-2 text-success"> $ {{$note->price}}</h4>
                <ul class="list-inline small">
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star-o text-gray"></i></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- End -->
        </li>
        @endforeach

      </ul>
      <!-- End -->
    </div>
  </div>
</div>
</section>
@endsection