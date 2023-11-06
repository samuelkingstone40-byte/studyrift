

<nav class="bg-white border-gray-200 dark:bg-gray-900 fixed top-0 z-50 w-full">
    <div class=" flex flex-wrap  justify-between items-center px-4 py-2 ">
        <div class="flex items-center justify-start">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
            <a href="{{url('/')}}" class="flex ml-2 md:mr-24">
                <img class="logo-2 w-64" src="{{asset('theme/img/site/logo.png')}}" alt="" />
            </a>
        </div>

        <div class="flex items-center md:order-2 lg:order-2">
            @guest
                <a href="{{url('login')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>
                <a href="{{url('register')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</a>
            @else
                @if(count((array) session('cart'))>0)
                    <div class="flex items-center ml-4">
                        <div>
                            <button type="button" class="flex text-lg " aria-expanded="false" data-dropdown-toggle="dropdown-cart">
                                <span class="sr-only">Open user menu</span>
                                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                                </svg>
                            </button>
                            <span class="sr-only">Notifications</span>
                            <div class="absolute inline-flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-0 ml-4  dark:border-gray-900">
                                {{ count((array) session('cart')) }}
                            </div>
                            
                        </div>
                    

                        <div class="z-50 w-96 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-cart">
                            <div class="px-4 py-3" role="none">
                                <div class="flex justify-between">
                                    <div> 
                                        Items ( {{ count((array) session('cart')) }})
                                    </div>
                                    <div>
                                        @php $total = 0 @endphp
                                        @foreach((array) session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                        @endforeach
                                        Total: <span class="text-info">$ {{ $total }}</span>
                                    </div>
                                </div>
                                <hr/>

                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        <div class="row cart-detail">
                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    
                                            <img class="img-thumbnail" src="{{$details['image']}}" alt="">

                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                <p class="text-md"><span>{{ $details['name'] }}</span></p>
                                                <span class="price text-bold text-md"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                              
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">Checkout</a>
                                        </div>
                                    </div>
                                @endif
                       
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex items-center ml-4">
                        <div>
                            <button type="button" class="flex text-lg " aria-expanded="false" data-dropdown-toggle="dropdown-message">
                            <span class="sr-only">Open user menu</span>
                            <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M8 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C15 15.4 15 16 14.462 16H1.538C1 16 1 15.4 1 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 8 3.464ZM4.54 16a3.48 3.48 0 0 0 6.92 0H4.54Z"/>
                            </svg>                    
                            </button>
                        </div>
                
                        <div class="z-50 w-96 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                        
                        
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{url('home')}}" class="block px-4 py-2 text-lg text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{url('profile')}}" class="block px-4 py-2 text-lg text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-lg text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                                </li>
                            
                                <li>
                                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="block px-4 py-2 text-lg text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                </div>
           
                <div class="flex items-center ml-4">
                            <div>
                                <button type="button" class="flex text-lg  rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            
                                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M10 19a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 11 14H9a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 10 19Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                </button>
                            </div>
                        
                            <div class="z-50 w-96 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                                <div>
                                    @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        <div class="row cart-detail">
                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    
                                            <img class="img-thumbnail" src="{{$details['image']}}" alt="">

                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                <p class="text-sm"><small>{{ $details['name'] }}</small></p>
                                                <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                        <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">Checkout</a>
                                
                                        <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="block px-4 py-2 text-lg text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                        </form>
                                    </li>
                                </ul>
                                </div>
                                </div>
                                </div>
                            </div>
                        
                </div>

          

                <button data-collapse-toggle="navbar-language" type="button" class="inline-flex items-center p-2 w-10 h-10 ml-2 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-language" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            @endguest
        </div>

        <div class="items-center  justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-language">
            <ul class="flex flex-col font-medium p-3 md:p-0   md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
                </li>
                <li>
                <a href="{{url('search')}}" class="block py-1  pr-4 text-lg font-semibold text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Browse</a>
                </li>
                <li>
                <a href="{{url('about-us')}}" class="block py-1 pl-3 pr-4 text-lg font-semibold text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                </li>

                <li>
                <a href="{{url('contact-us')}}" class="block py-1 pl-3 pr-4 text-lg font-semibold text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                </li>
            </ul>
        </div>


     
    </div>
  </nav>
  