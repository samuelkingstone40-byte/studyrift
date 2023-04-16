
<title>Login-Studymerit</title>
@extends('layouts.app')
@section('content')
<section class="section_gap">

  <div class="login-section" >

    <div class="login-container">
    
    <!-- <div class="py-2 text-center div-image">
      <img class="img-fluid" src="{{asset('theme/img/logo-new.png')}}"/>
    </div> -->
    
        <div class="register_form">
          <div class="header-section">
            <img class="img-fluid login-avatar" src="{{asset('theme/img/user.png')}}"/>
            <p>Sign In</p>
          </div>
      

          <div class="">
         
           
          <form  class="form_area" method="POST" action="{{ route('login') }}">
            @csrf
              <div class="form-group">
                <input id="email" type="email" placeholder="Your Email Address" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
              </div>
              <div class="form-group">
                      <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
              </div>
              <div class="form-group text-center">
                         <button type="submit" class="primary-btn">Login</button>
              </div>
              <div class="row g-2">
                <div class="col-lg-6 col-md-6 col-sm-12">
                   <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="form-check-label" for="remember">{{ __('Remember Me') }} </label>
                   </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="text-right">
                    @if (Route::has('password.request'))
                      <a class="" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    @endif
                  </div>
                </div>
              </div>

            
                      <!-- <div class="form-group">
                         <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Remember Me') }} </label>
                      </div> -->
                      <div class="form-group">
                        {!! RecaptchaV3::initJs() !!}
                        {!! RecaptchaV3::field('contact-us') !!}
                        @error('g-recaptcha-response')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                     
                   
          
                
                
                
                 

                </div>
                <div class="">
                 <p>I dont have an account? <span>
                  <a class="btn btn-link" href="{{ route('register') }}">
                    <b> Sign Up</b>
                  </a>
                </span></p> 
                               
                  </div>

              </form>
          </div>
        </div>
    </div>     

</section>
       
@endsection
