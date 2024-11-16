<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <meta name = "keywords" content = "Study notes,study materials,term papers,textbooks" />
    <meta name = "description" content = " Find study materials, textbooks and other study instruments for all subjects. Find all the documents you need by looking for your subject." />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Get quality notes in one place</title>

    
    <link rel="icon" href="{{asset('theme/img/site/favicon.png')}}" sizes="48*48" type="image/png" />
    <title>{{ config('app.name', 'Studymerit') }}</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('theme/css/flaticon.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/css/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/vendors/owl-carousel/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/vendors/nice-select/css/nice-select.css')}}" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('theme/css/nav.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/css/cart.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/css/custom.css?v='.filemtime(public_path('theme/css/custom.css'))) }}" />
    <link rel="stylesheet" href="{{asset('theme/css/style.css?v='.filemtime(public_path('theme/css/style.css'))) }}" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <script src="{{ mix('js/app.js') }}"></script>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','G-K08LVCH03Q');</script>
  </head>

  <body>
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=G-K08LVCH03Q"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!--================ Start Header Menu Area =================-->
    @include('includes.header')


    @guest
    <input type="hidden" id="user_id" value="">
    <input type="hidden" id="name" value="">
    <input type="hidden" id="email" value="">
    @else
    <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
    <input type="hidden" id="name" value="{{Auth::user()->name}}">
    <input type="hidden" id="email" value="{{Auth::user()->email}}">
    @endguest

    <div class="">
     @yield('content')
    </div>


      
</div>

    @include('includes.footer')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{asset('theme/js/jquery-3.2.1.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
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
    <script>

       document.tidioIdentify = {
       distinct_id: $('#user_id').val(), // Unique visitor ID in your system
       email: $('#email').val(), // visitor email
       name: $('#name').val() // Visitor name
    
};
    </script>
    <script src="//code.tidio.co/mu88s7xwwrvlzzyhy4e17htqi2xrgcg8.js" async></script>
    <script>
  $(document).ready(function(){
     getMessage();
    function getMessage() {
   
            $.ajax({
               type:'POST',
               url:'{{route("notifications")}}',
               data: {
                _token: '{{ csrf_token() }}', 
               
            },
               success:function(data) {
                
                console.log(data)
                appendData(data);
                
               }
            });
         }
    //  Echo.private('App.Models.User.3')
    //    .notification((notification) => {
    //     getMessage();
    // });

    function appendData(data) {
            var mainContainer = document.getElementById("top");
            var length = 0;
            for (var i = 0; i < data.length; i++) {
                var div = document.createElement("div");
                if(data[i].read==null){
                  var msg='<small class="text_msg font-weight-bold">'+data[i].message.message+'</small>\n'
                ++length;
                }else{
                  var msg='<small class="text_msg ">'+data[i].message.message+'</small>\n'
                }
                div.innerHTML ='<a class="dropdown-item d-flex align-items-center mark"  href="{{url("view-document")}}/'+data[i].message.slug+'">\n' +
                 '<div class="mr-3">\n' +
                     '<div class="icon-circle"> <i class="fa fa-cloud-download"></i> </div>\n' +
                 '</div>\n' +
                 '<div>\n' +
                     '<div class="small text-gray-500">'+data[i].date+'</div>\n' +
                      msg +
                '</div>\n' +
             '</a>'
                
                
              
               
                mainContainer.appendChild(div);
               
            }

            $('#count').html(length)
        }
   
})
    </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    @yield('scripts')

  </body>
</html>
