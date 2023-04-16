@extends('layouts.app')

@section('content')
<section class="section_gap">
  <div class="login-section">
    <div class="justify-content-center">
          <div class="register_form reset">
              <div class="text-center">
                <h3 class="mb-2">{{ __('Forgot Password') }}</h3>
              </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p class="mb-2">Enter your registered email ID to reset the password</p>

                <form method="POST" action="{{ route('password.email') }}">
                  @csrf
                   
                      <div class="form_group">
                                <input id="email" type="email" placeholder="Email Address" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                       </div>
                

                        <div class="form-group">
                                <button type="submit" class="primary-btn">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                        </div>
                
                    </form>
                </div>
            
        </div>
    </div>
</div>
</section>
@endsection
