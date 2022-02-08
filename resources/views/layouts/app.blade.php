<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <link rel="icon" href="{{asset('theme/img/favicon.png')}}" type="image/png" />
    <title>{{ config('app.name', 'Laravel') }}</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/css/flaticon.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/css/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/vendors/owl-carousel/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/vendors/nice-select/css/nice-select.css')}}" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('theme/css/nav.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/css/cart.css')}}" />

    <link rel="stylesheet" href="{{asset('theme/css/style.css')}}" />
  </head>

  <body>
    <!--================ Start Header Menu Area =================-->
    @include('includes.header')
    <div>
 
            @yield('content')
      
</div>
    
    @include('includes.footer')
    <script src="{{asset('theme/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('theme/js/popper.js')}}"></script>
    <script src="{{asset('theme/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('theme/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('theme/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('theme/js/owl-carousel-thumb.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="{{asset('theme/js/jquery.ajaxchimp.min.js')}}"></script> -->
    <!-- <script src="{{asset('theme/js/mail-script.js')}}"></script> -->
    <!--gmaps Js-->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script> -->
    <!-- <script src="{{asset('theme/js/gmaps.min.js')}}"></script> -->
    <!-- <script src="{{asset('pdfjs/build/pdf.js')}}"></script>
    <script src="{{asset('pdfjs/build/pdf.worker.js')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>

    <script src="{{asset('theme/js/theme.js')}}"></script>
    @yield('scripts')

  </body>
</html>
