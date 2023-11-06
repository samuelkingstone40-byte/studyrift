@extends('layouts.client_layout')
@section('content')

<section class="mt-10">
  <div class="text-3xl font-bold mb-4">Account Profile & Settings</div>
  <div class="grid-container grid grid-cols-12 gap-4">
    <div class="item1 col-span-4">
      <div class=" bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
            <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export Data</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center pb-10">
          <div class=" mb-2 relative inline-flex items-center justify-center w-12 h-12 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
            <span class="font-medium text-xl text-gray-600 dark:text-gray-300">{{substr($user->name, 0, 1)}}</span>
        </div>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->name}}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{$user->email}}</span>
          
        </div>
      </div>

    </div>

    <div class="item1 col-span-8">
      <div class=" p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form method="post" action="{{route('update-profile')}}">
          @csrf
         <div class="form-group mb-3 ">
             <label class="form-label text-lg">Name</label>
             <div >
               <input type="text" class="text-lg bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" aria-describedby="emailHelp" placeholder="Enter Your Name" value="{{$user->name}}" name="name">
             </div>
           </div>
           <div class="form-group mb-3 ">
             <label class="form-label text-lg">Email address</label>
             <div >
               <input type="email" value="{{$user->email}}" name="email" class="text-lg bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" aria-describedby="emailHelp" aria-describedby="emailHelp" placeholder="Enter email">
             </div>
           </div>
           <div class="form-footer">
             <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
           </div>
         </form>
      </div>

      <div class=" p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-xl font-semibold mb-3">Update Paypal Account</h2>
        <form method="post" action="{{route('update-paypal')}}">
          @csrf
         <div class="form-group mb-3 ">
          <label for="inputAddress" class="text-lg">Paypal Email</label>
          <input value="{{$user->paypalEmail}}" name="paypal" required type="email" class="text-lg bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" aria-describedby="emailHelp" placeholder="Enter Paypal Email" id="inputAddress" >
        </div>
          
        <div class="form-footer">
           <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Paypal Email</button>
        </div>
         </form>
      </div>

      <div class=" p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form method="post" action="{{route('update-password')}}"> 
          @csrf
         <div class="form-group mb-3 ">
         <label for="inputAddress">New Password</label>
           <div>
             <input id="password" type="password" placeholder="Enter Password" class="text-lg bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" aria-describedby="emailHelp" placeholder="Enter Password" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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
           <input id="password-confirm" type="password" placeholder="Confirm Password" class="text-lg bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" aria-describedby="emailHelp" placeholder="Enter Password" name="password_confirmation" required autocomplete="new-password">
                 @error('password')
                     <span class="invalid-feedback d-block" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
             </div>
           </div>
           <div class="form-footer">
           <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Change Password</button>
           </div>
         </form>
      </div>

      <div class=" p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h1 class="text-xl font-bold">Deactivate Account</h1>
        <form method="post" action="{{route('deactivate-account')}}">
          @csrf
          <div class="form-group mb-3">
           <label for="inputAddress">Deactivate this account</label>
          </div>
          <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Deactivate Account</button>
        </form>
      </div>
    
    </div>
  </div>
</section>


@endsection