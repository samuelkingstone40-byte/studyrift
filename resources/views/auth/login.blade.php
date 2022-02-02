@extends('layouts.app')

@section('content')
<section class="section_gap">
<div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 offset-lg-1">
            <div class="register_form">
              <h3>Sign In</h3>
           
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
                   
                  </div>
                  <div class="col-lg-12 text-left">
                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                  </div>
                 </div>
                 
                
                  <div class="col-lg-12 text-center">
                    <button type="submit" class="primary-btn">Submit</button>
                   
                  </div>
                  <div class="col-lg-12 text-right">
                  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                  </div>
                </div>
              </form>
            </div>
          </div>
          </section>
@endsection
