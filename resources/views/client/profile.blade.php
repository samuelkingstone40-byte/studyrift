@extends('layouts.client')
@section('content')
<div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                 Account Profile & Settings
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
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
          <div class="row row-cards">
          <div class="col-md-6 col-xl-5">
              <div class="card">
                      <div class="card-body p-4 py-5 text-center">
                        <span class="avatar avatar-xl mb-4 avatar-rounded">{{substr($user->name, 0, 1);}}</span>
   
                        <h3>{{$user->name}}</h3>
                      </div>
                      
                    </div>

              </div>
          <div class="col-md-6 col-xl-7">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Basic form</h3>
                </div>
                <div class="card-body">
                <form method="post" action="{{route('update-profile')}}">
                   @csrf
                  <div class="form-group mb-3 ">
                      <label class="form-label">Name</label>
                      <div >
                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Your Name" value="{{$user->name}}" name="name">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Email address</label>
                      <div >
                        <input type="email" value="{{$user->email}}" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                      </div>
                    </div>


                    <div class="form-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="card mt-2">
                <div class="card-header">
                  <h3 class="card-title">Update Paypal Email</h3>
                </div>
                <div class="card-body">
                  <form method="post" action="{{route('update-paypal')}}">
                   @csrf
                  <div class="form-group mb-3 ">
                  <label for="inputAddress">Paypal Email</label>
                      <div >
                      <input value="{{$user->paypalEmail}}" name="paypal" required type="email" class="form-control" id="inputAddress" placeholder="Paypal Email">
                      </div>
                    </div>
                    <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Update Paypal Email</button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="card mt-2">
                <div class="card-header">
                  <h3 class="card-title">Change Password</h3>
                </div>
                <div class="card-body">
                <form method="post" action="{{route('update-password')}}"> 
                   @csrf
                  <div class="form-group mb-3 ">
                  <label for="inputAddress">New Password</label>
                    <div>
                      <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                          @error('password')
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group mb-3 ">
                      <label for="inputPassword4">Confirm Password</label>
                    <div>
                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                          @error('password')
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>
                    <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Update Paypal Email</button>
                    </div>
                  </form>
                </div>
              </div>

            <div class="card mt-2">
            <div class="card-body">
            <form method="post" action="{{route('deactivate-account')}}">
              @csrf
              <div class="form-group mb-3">
               <label for="inputAddress">Deactivate this account</label>
              </div>
              <button type="submit" class="btn btn-danger">Deactivate Account</button>
            </form> 
            </div>
        </div>



              </div>
           
          </div>
            <!-- Content here -->
          </div>
        </div>

@endsection