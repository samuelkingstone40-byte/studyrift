@extends('layouts.app')
@section('content')
<section class="section_gap">
    <div class="container">
    <div class="jumbotron text-center">
  <h1 class="display-4 text-danger">Cancelled! <i class="fa fa-frown-o" aria-hidden="true"></i></h1>
  <p class="lead"><strong>You have cancelled your payment process</strong> Your account has not been credited.</p>
  <hr>
  <p>
    Having trouble? <a href="">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="{{url('home')}}" role="button">Continue to homepage</a>
  </p>
</div>
    </div>
</section>
@endsection