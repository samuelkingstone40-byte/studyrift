@extends('layouts.app')

@section('content')
<section class="section_gap">
<div class="container">
<div class="row py-2">
<div class="col-md-4 col-sm-6 col-xs-12">
        	<div class="card">
        		<div class="card-body text-center">
        			<p class="text-uppercase font-weight-bold ">Uploads</p>
                    <i class="ti-upload"></i>
        			<hr>
        			<p class="h2 font-weight-bold text-info">0</p>
        		
        		</div>
        	</div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
        	<div class="card">
        		<div class="card-body text-center">
        			<p class="text-uppercase font-weight-bold">Downloads</p>
                    <i class="ti-download ti-5x"></i>
        			<hr>
        			<p class="h2 font-weight-bold text-warning">0</p>
        		
        		</div>
        	</div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
        	<div class="card">
        		<div class="card-body text-center">
        			<p class="text-uppercase font-weight-bold">Earnings</p>
                    <i class="ti-money"></i>
        			<hr>
        			<p class="h2 font-weight-bold text-success">0.00</p>
        		
        		</div>
        	</div>
        </div>
         


    
        </div>
    </div>
</div>
</section>
@endsection
