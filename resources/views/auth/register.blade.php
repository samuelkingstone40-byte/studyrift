

@extends('layouts.default')
@section('content')
<section class="section_gap">
<div class="login-section" >

<div class="login-container">
       
        <div class="register_form ">
            <div class="text-center py-1">
             
            <h3 class="py-4">CREATE ACCOUNT</h3>
            </div>
              
           
              <form  class="form_area" method="POST" action="{{ route('register') }}">
                        @csrf
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <input id="name" type="text" placeholder="Your Name" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        
                      <input id="email" type="email" placeholder="Your Email Address" class="@error('email') is-invalid @enderror form-control" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                      <div class="form-group">
                      <input id="password" type="password" placeholder="Enter Password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                      <div class="form-group">
                         <input id="password-confirm" type="password" placeholder="Confirm Password" class="" name="password_confirmation" required autocomplete="new-password">
                      </div>
                      <div class="form-group">
                                     
                      
                     </div>
                    <div class="form-group">
                    <button type="submit" class="primary-btn">Submit</button>
                   
                    </div>
                   
                
                  <div class=" ">
                    <p>Already have an account? <span>
                     <a  href="{{ route('login') }}">
                       <b> Sign In</b>
                     </a>
                   </span></p> 
                                  
                     </div>
                  </div>
                
                 </div>
                 
                
                 
               

                
              </form>
            </div>
        
    </div>
</div>
</section>



@endsection
