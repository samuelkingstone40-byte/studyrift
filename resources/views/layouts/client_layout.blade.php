<html>
    <head>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name = "keywords" content = "Study notes,study materials,term papers,textbooks" />
        <meta name = "description" content = " Find study materials, textbooks and other study instruments for all subjects. Find all the documents you need by looking for your subject." />
        <title>Get quality notes in one place</title>

        <!-- CSS files -->
        <link rel="icon" href="{{asset('theme/img/site/favicon.png')}}" type="image/png" />      
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
    <body class="bg-slate-50">
        <!--start side bar -->
        <div id="sidebar" class="z-50 w-64 h-screen bg-gray-900 text-white fixed transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <div class="flex justify-between items-center px-4 pt-4">
                <a href="{{url('/')}}" class="flex item-center pb-2 px-2 border-b border-b-gray-800">
                    <img src="{{asset('theme/img/site/logo.png')}}" class="w-32 lg:w-full px-1 object-cover lg:p-4" alt="logo" srcset="">
                </a>
                <button class="lg:hidden" onclick="toggleSidebar()" >X</button>
            </div>    
          
                <ul class="mt-2 mx-1 ">
                    <li class="mb-4 group active">
                        <a href="{{url('home')}}" class="flex items-center  px-4 py-2  text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white">
                            <i class="ri-home-line mr-3 text-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-4 group">
                        <a href="{{url('downloads')}}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white">
                            <i class="ri-file-download-line mr-3 text-lg"></i>
                            <span>Downloads</span>
                        </a>
                    </li>
                    <li class="mb-4 group" >
                        <a href="{{url('uploads')}}" class="flex items-center  px-4 py-2 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white">
                           <i class="ri-file-upload-line mr-3 text-lg"></i>
                            <span>Uploads</span>
                        </a>
                    </li>
                    <li class=" group">
                        <a href="{{url('earnings')}}" class="flex items-center  px-4 py-2  text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white">
                            <i class="ri-exchange-dollar-line mr-3 text-lg"></i>
                            <span>Sales</span>
                        </a>
                    </li>
                </ul>
               
        </div>
        <main class="flex-1 lg:ml-64 ">
            <div class="py-2 px-6 flex bg-white items-center shadow-md shadow-black">
                <button id="close_siderbar" type="button" class="text-lg text-gray-500 lg:hidden" onclick="toggleSidebar()">
                    <i class="ri-menu-line"></i>
                </button>
               
                <ul class="ml-auto flex items-center">
                    <li class="mr-1">
                        <button type="button" class="text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                            <i class="ri-notification-3-line"></i>
                        </button>
                    </li>
                    <li class="mr-1">
                        <button type="button" class="text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                            <i class="ri-notification-3-line"></i>
                        </button>
                    </li>

                    <li class="mr-1">
                        <a
                href="{{ route('logout') }}"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                  class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                  >Sign out
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                    </li>
                </ul>
            </div>
            <div class="py-2 px-4 bg-gray">
                @yield('content')
            </div>
        </main>

    
     <!-- Libs JS -->
     <script src="{{asset('theme/js/jquery-3.2.1.min.js')}}"></script>
     <script src="{{asset('admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
     <script src="{{asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('admin/assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('admin/assets/extra-libs/c3/c3.min.js')}}"></script>
     <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
     <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>
    <script >
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        }

       
    </script>
    @yield('scripts')
    </body>
</html>