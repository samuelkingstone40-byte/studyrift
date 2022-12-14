
<title>Login-Studymerit</title>
@extends('layouts.app')
@section('content')
<section class="section_gap ">
  <div class="container py-4" >
    <div class="row justify-content-center">
      <div class="col-lg-7 offset-lg-1">
        <div class="register_form">
          <div class="py-4 text-center">
            <h2>Studymerit</h2>
          </div>

          <div class="body mt-2">
            <h4 class="py-2">Please provide your credentials </h4>
           
          <form  class="form_area" method="POST" action="{{ route('login') }}">
                        @csrf
                <div class="row">
                  <div class="col-lg-12 form_group">
                      <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" placeholder="you@host.com" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                      <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

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
                        {!! RecaptchaV3::initJs() !!}
                        {!! RecaptchaV3::field('contact-us') !!}
                        @error('g-recaptcha-response')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
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
    </div>     
  </div>
</section>
       
@endsection
