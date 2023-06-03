

<header class="header_area white-header ">
      <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
         
            <!-- Brand and toggle get grouped for better mobile display -->
            @guest
            <a class="navbar-brand" href="{{url('/')}}">
              <img class="logo-2 img-fluid" src="{{asset('theme/img/site/logo.png')}}" alt="" />
            </a>
            @else
            <a class="navbar-brand" href="{{url('home')}}">
              <img class="logo-2 img-fluid" src="{{asset('theme/img/site/logo.png')}}" alt="" />
            </a>
            @endguest
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon-bar"></span> <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset mr-4" id="navbarSupportedContent">

         


              <ul class="nav navbar-nav menu_nav ma-5 ml-auto">
              <li class="nav-item">
                  <a class="nav-link" href="{{url('upload')}}">Upload <i class="fa fa-upload fa-lg ml-2"></i></a>
                </li>     
                <li class="nav-item">
                  <a class="nav-link" href="{{route('search', array('search_text' => '') )}}">Buy <i class="fa fa-download fa-lg ml-2" aria-hidden="true"></i></a>
                </li> 
                @if(count((array) session('cart'))>0)
                <li class="nav-item">
                <div class="dropdown">
                <a class="nav-link" style="color:white;font:700"  data-toggle="dropdown">
                        <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> 
                   
                         <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                        
                      </a>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            <div class="col-lg-6 col-sm-6 col-6">
                                <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                            </div>
                            @php $total = 0 @endphp
                            @foreach((array) session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                            @endforeach
                            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                            </div>
                        </div>
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
                            </div>
                        </div>
                    </div>
                </div>

                </li>
                @endif
              @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                       
                <li class="nav-item dropdown no-arrow mx-1 mr-4"> <a class="nav-link dropdown-toggle"  id="msg" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bell fa-lg"></i>
                 <span class="badge badge-danger badge-counter" id="count"></span> </a>
         <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
             <h6 class="dropdown-header"> Alerts Center </h6> 
             <div id="top"></div>
             <a class="dropdown-item text-center small text-gray-500" href="#">Show All</a>
         </div>
     </li>
     <li class="nav-item dropdown no-arrow mx-1 ml-2"> <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-envelope fa-lg"></i> <span class="badge badge-danger badge-counter">0</span> </a>
         <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
             <h6 class="dropdown-header"> Messages </h6> <a class="dropdown-item d-flex align-items-center" href="#">
                
                 <a class="dropdown-item text-center small text-gray-500" href="#">Read all Messages</a>
         </div>
     </li>
     <div class="topbar-divider d-none d-sm-block"></div>
     <li class="nav-item dropdown no-arrow ml-4"> <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span> <img class="img-profile rounded-circle" src="{{asset('thumbnails/'.Auth::user()->image)}}"> </a>
         <div style="width:230px" class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
           <a class="dropdown-item" href="{{url('home')}}"> <i class="fa fa-tachometer  fa-sm fa-fw mr-2 text-gray-400"></i>Dashboord </a>
           <a class="dropdown-item" href="{{url('uploads')}}"> <i class="fa fa-cloud-upload fa-sm fa-fw mr-2 text-gray-400"></i>Uploads </a>
           <a class="dropdown-item" href="{{url('downloads')}}"> <i class="fa fa-cloud-download fa-sm fa-fw mr-2 text-gray-400"></i>Downloads </a>
           <a class="dropdown-item" href="{{url('earnings')}}"> <i class="fa fa-money  fa-sm fa-fw mr-2 text-gray-400"></i>Earning </a>
           <a class="dropdown-item" href="{{url('profile')}}"> <i class="fa fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Profile Settings </a>
          <div class="dropdown-divider"></div>
          <a class=" dropdown-item mr-2" href="{{ route('logout') }}"  onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>     {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
</form>
                    
         </div>
     </li>
    @endguest

 </ul>
            </div>
         
        </nav>
      </div>


    </header>




    @section('scripts')


 
@endsection