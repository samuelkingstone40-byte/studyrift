@extends('layouts.app')

@section('content')
<section class="section_gap">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="register_form">
              <div class="text-center">
              <h3 class="mb-5">{{ __('Reset Password') }}</h3>

              </div>
           
          
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row">
                  <div class="col-lg-12 form_group">
                                <input id="email" type="email" placeholder="Email Address" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                                <button type="submit" class="primary-btn">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
