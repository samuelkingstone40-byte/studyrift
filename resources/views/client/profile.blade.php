@extends('layouts.app')
@section('content')
<section class="section_gap">
  <div class="container">
    <h4 class="mb-2">Edit Profile</h4>
         @if (\Session::has('success'))
          <div class="alert alert-success">
            {!! \Session::get('success') !!}   
           </div>
        @endif

        @if (\Session::has('error'))
          <div class="alert alert-danger">
            {!! \Session::get('error') !!}   
           </div>
        @endif
    <div class="row justify-content-left">
      
      <div class="col-sm-4">
        
        <div class="card">
          <div class="card-body">
            <div class=" align-items-center ">
              <img class="rounded-circle mb-2"  src="{{asset('profiles/'.$user->image)}}" >
              <form action="{{route('uploadImg')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
               
                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
              </div>
              <button type="submi" class="primary-btn"> Upload</button>
              </form>
            </div>
          </div>
        </div>
      </div>
        <div class="col-sm-10 mt-4 mb-4">
         
        <div class="card">
            <div class="card-body">
              
            <form meth0d="post" action="{{route('update-profile')}}">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Name</label>
                  <input required value="{{$user->name}}" name="name" type="text" class="form-control" id="inputEmail4" placeholder="Name">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Email</label>
                  <input required value="{{$user->email}}" name="email" type="email" class="form-control" id="inputPassword4" placeholder="Email">
                </div>
              </div>
                <button type="submit" class="primary-btn">Update</button>
            </form> 
            </div>
        </div>
    </div>

    <div class="col-sm-10 mb-4">
         <h4 class="mb-2">Paypal Email</h4>
        <div class="card">
            <div class="card-body">
            <form method="post" action="{{route('update-paypal')}}">
              @csrf
                <div class="form-group">
                  <label for="inputAddress">Paypal Email</label>
                  <input value="{{$user->paypalEmail}}" name="paypal" required type="email" class="form-control" id="inputAddress" placeholder="Paypal Email">
                </div>
               <button type="submit" class="primary-btn">Update Paypal Email</button>
            </form> 
            </div>
        </div>
    </div>
    <div class="col-sm-10 mb-4">
         <h4 class="py-2">Edit Password</h4>
        <div class="card">
            <div class="card-body">
            <form method="post" action="{{route('update-password')}}"> 
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">New Password</label>
                    <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">Confirm Password</label>
                      <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                  </div>
                  <button type="submit" class="primary-btn">Update</button>
             </form> 
            </div>
        </div>
    </div>

    <div class="col-sm-10 mb-4">
         <h4 class="mb-2">Deactivate Account</h4>
        <div class="card">
            <div class="card-body">
            <form method="post" action="{{route('deactivate-account')}}">
              @csrf
              <div class="form-group">
               <label for="inputAddress">Deactivate this account</label>
              </div>
              <button type="submit" class="primary-btn">Deactivate Account</button>
            </form> 
            </div>
        </div>
    </div>

  </div>
  </div>
</section>
@endsection