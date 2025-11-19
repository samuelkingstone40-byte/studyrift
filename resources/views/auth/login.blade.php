

@extends('layouts.default')
<link href="{{secure_asset('theme/css/login.css')}}" rel="stylesheet">
<title>Login - Study Rift</title>

@section('content')
  <section class="bg-gray-50  dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center mb-10 px-6 pt-40 md:pt-0 mx-auto md:h-screen lg:py-0"> 
        <div class="w-full max-w-sm p-2 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
          <form class="space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Sign in to your account</h5>
              <div>
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                  <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                  <span class="text-red-500 text-xs" role="alert">
                      <strong>{{ $message }}</strong></span>
                  @enderror
              </div>
              <div>
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                  <input type="password" name="password" id="password" placeholder="••••••••" class="@error('password') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                  @error('password')
                    <span class="text-red-500 text-xs" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
              <div class="flex items-start">
                  <div class="flex items-start">
                      <div class="flex items-center h-5">
                          <input  type="checkbox" value=""  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" >
                      </div>
                      <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                  </div>
                  <a href="#" class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
              </div>
              <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
              <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                  Not registered? <a href="{{route('register')}}" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
              </div>
              <div class="">
                {!! RecaptchaV3::initJs() !!}
                {!! RecaptchaV3::field('contact-us') !!}
                @error('g-recaptcha-response')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                </div>
          </form>
        </div>
    </div>
  </section>
@endsection
