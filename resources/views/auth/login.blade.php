@extends('layouts.app')

@section('content')
<section class="section_gap">
<div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 offset-lg-1">
            <div class="register_form">
              <div class="text-center mb-4">
                  <h3>Sign In</h3>
              </div>
              
           
              <form  class="form_area" method="POST" action="{{ route('login') }}">
                        @csrf
                <div class="row">
                  <div class="col-lg-12 form_group">
                      <div class="form-group">
                      <input id="email" type="email" placeholder="Your Email Address" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                      <div class="form-group">
                      <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                      <div class="form-group">
                         <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Remember Me') }} </label>
                      </div>

                      <div class="form-group">
                         <button type="submit" class="primary-btn">Submit</button>
                      </div>
                   
                  </div>
                 
                 </div>
                 
                
                
                  <div class="col-lg-12 text-right">
                  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                  </div>
                 

                </div>
                <div class="col-lg-12 ">
                 <h4>I dont have an account? <span>
                  <a class="btn btn-link" href="{{ route('register') }}">
                    <b> Sign Up</b>
                  </a>
                </span></h4> 
                               
                  </div>

              </form>
             
            </div>
            
          </div>


</section>
       
@endsection
