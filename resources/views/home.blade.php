@extends('layouts.app')

@section('content')
<section class="section_gap">
	
<div class="container">
	
<div class="row py-2">
<div class="col-md-4 col-sm-6 col-xs-12">
	<a href="{{url('uploads')}}" class="text-transform:none;">
        	<div class="card">
        		<div class="card-body text-center">
        			<p class="text-uppercase font-weight-bold ">Uploads</p>
                    <i class="ti-upload"></i>
        			<hr>
        			<p class="h2 font-weight-bold text-info">{{$count_uploads}}</p>
        		
        		</div>
        	</div>
			</a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
		<a href="{{url('downloads')}}" class="text-transform:none;">
        	<div class="card">
        		<div class="card-body text-center">
        			<p class="text-uppercase font-weight-bold">Downloads</p>
                    <i class="ti-download ti-5x"></i>
        			<hr>
        			<p class="h2 font-weight-bold text-warning">{{$count_downloads}}</p>
        		
        		</div>
        	</div>
        </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
		<a href="{{url('earnings')}}" class="text-transform:none;">
        	<div class="card">
        		<div class="card-body text-center">
        			<p class="text-uppercase font-weight-bold">Earnings</p>
                    <i class="ti-money"></i>
        			<hr>
        			<p class="h2 font-weight-bold text-success">$ {{number_format($earnings,2)}}</p>
        		
        		</div>
        	</div>
        </a>
        </div>
         


    
        </div>
    </div>
</div>
</section>
@endsection
