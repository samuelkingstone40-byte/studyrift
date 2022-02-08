@extends('layouts.app')
@section('content')
<section class="section_gap">
    <div class="container">
    <div class="jumbotron text-center">
  <h1 class="display-4 text-success">Success! <i class="fa fa-smile-o" aria-hidden="true"></i></h1>
  <p class="lead"><strong>Your payment has been received</strong> Proceed to download your documents.</p>
  <hr>
  <p>
    Having trouble? <a href="">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="{{url('downloads')}}" role="button">Continue to downloads</a>
  </p>
</div>
    </div>
</section>
@endsection