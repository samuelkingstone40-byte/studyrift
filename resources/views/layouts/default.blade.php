<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" href="{{asset('theme/img/favicon.png')}}" type="image/png" />
    <title>{{ config('app.name', 'Laravel') }}</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/css/flaticon.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/css/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/vendors/owl-carousel/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/vendors/nice-select/css/nice-select.css')}}" />
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('theme/css/nav.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/css/style.css')}}" />
  </head>

  <body>
    <!--================ Start Header Menu Area =================-->
    <header class="header_area white-header">
      <div class="main_menu">
        <div class="search_input" id="search_input_box">
          <div class="container">
            <form class="d-flex justify-content-between" method="" action="">
              <input
                type="text"
                class="form-control"
                id="search_input"
                placeholder="Search Here"
              />
              <button type="submit" class="btn"></button>
              <span
                class="ti-close"
                id="close_search"
                title="Close Search"
              ></span>
            </form>
          </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="{{url('home')}}">
              <img class="logo-2" src="{{asset('theme/img/logo2.png')}}" alt="" />
            </a>
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
            <div
              class="collapse navbar-collapse offset"
              id="navbarSupportedContent"
            >

     


              <ul class="nav navbar-nav menu_nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link" href="{{url('upload')}}">Sell Documents</a>
                </li>
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
                       
                <li class="nav-item dropdown no-arrow mx-1 mr-4"> <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bell fa-fw"></i> <span class="badge badge-danger badge-counter">3+</span> </a>
         <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
             <h6 class="dropdown-header"> Alerts Center </h6> <a class="dropdown-item d-flex align-items-center" href="#">
                 <div class="mr-3">
                     <div class="icon-circle"> <i class="fa fa-file"></i> </div>
                 </div>
                 <div>
                     <div class="small text-gray-500">March 12, 2020</div> <span class="font-weight-bold">related snippets sent</span>
                 </div>
             </a> <a class="dropdown-item d-flex align-items-center" href="#">
                 <div class="mr-3">
                     <div class="icon-circle"> <i class="ti ti-user"></i> </div>
                 </div>
                 <div>
                     <div class="small text-gray-500">Feb 7, 2020</div> you updated your profile!
                 </div>
             </a> <a class="dropdown-item d-flex align-items-center" href="#">
                 <div class="mr-3">
                     <div class="icon-circle"> <i class="fa fa-download"></i> </div>
                 </div>
                 <div>
                     <div class="small text-gray-500">Jan 2, 2020</div> You just downloaded 3 snippets
                 </div>
             </a> <a class="dropdown-item text-center small text-gray-500" href="#">Show All</a>
         </div>
     </li>
     <li class="nav-item dropdown no-arrow mx-1 ml-2"> <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-bell"></i> <span class="badge badge-danger badge-counter">4</span> </a>
         <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
             <h6 class="dropdown-header"> Messages </h6> <a class="dropdown-item d-flex align-items-center" href="#">
                 <div class="dropdown-list-image mr-3"> <img class="rounded-circle" src="https://i.imgur.com/nUNhspp.jpg" alt="">
                     <div class="status-indicator bg-success"></div>
                 </div>
                 <div class="font-weight-bold">
                     <div class="text-truncate">Thanks for your answer!</div>
                     <div class="small text-gray-500">Andy flower · 8m</div>
                 </div>
             </a> <a class="dropdown-item d-flex align-items-center" href="#">
                 <div class="dropdown-list-image mr-3"> <img class="rounded-circle" src="https://i.imgur.com/uIgDDDd.jpg" alt="">
                     <div class="status-indicator"></div>
                 </div>
                 <div>
                     <div class="text-truncate">Can you answer bbb?</div>
                     <div class="small text-gray-500">John wrong · 4h</div>
                 </div>
             </a> <a class="dropdown-item d-flex align-items-center" href="#">
                 <div class="dropdown-list-image mr-3"> <img class="rounded-circle" src="https://i.imgur.com/HjKTNkG.jpg" alt="">
                     <div class="status-indicator bg-warning"></div>
                 </div>
                 <div>
                     <div class="text-truncate">Your work is awesome</div>
                     <div class="small text-gray-500"> Stanley · 12h</div>
                 </div>
             </a> <a class="dropdown-item d-flex align-items-center" href="#">
                 <div class="dropdown-list-image mr-3"> <img class="rounded-circle" src="{{asset('theme/img/testimonials/t1.jpg')}}" alt="">
                     <div class="status-indicator bg-success"></div>
                 </div>
                 <div>
                     <div class="text-truncate">Thanks for your support</div>
                     <div class="small text-gray-500">grand misi · 2w</div>
                 </div>
             </a> <a class="dropdown-item text-center small text-gray-500" href="#">Read all Messages</a>
         </div>
     </li>
     <div class="topbar-divider d-none d-sm-block"></div>
     <li class="nav-item dropdown no-arrow ml-4"> <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span> <img class="img-profile rounded-circle" src="{{asset('theme/img/testimonials/t1.jpg')}}"> </a>
         <div style="width:230px" class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
           <a class="dropdown-item" href="{{url('home')}}"> <i class="fa fa-tachometer  fa-sm fa-fw mr-2 text-gray-400"></i>Dashboord </a>
           <a class="dropdown-item" href="{{url('uploads')}}"> <i class="fa fa-cloud-upload fa-sm fa-fw mr-2 text-gray-400"></i>Uploads </a>
           <a class="dropdown-item" href="#"> <i class="fa fa-cloud-download fa-sm fa-fw mr-2 text-gray-400"></i>Downloads </a>
           <a class="dropdown-item" href="#"> <i class="fa fa-money  fa-sm fa-fw mr-2 text-gray-400"></i>Earning </a>
           <a class="dropdown-item" href="{{url('profile')}}"> <i class="fa fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Profile Settings </a>
          <div class="dropdown-divider"></div>
          <a class="mr-2" href="{{ route('logout') }}"  onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>     {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                    
         </div>
     </li>
    @endguest
     <li class="nav-item">
                  <a href="#" class="nav-link search" id="search">
                    <i class="ti-search"></i>
                  </a>
                </li>
 </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <section class="section_gap">
    <main class="py-1">
            @yield('content')
        </main>
</section>
    
    <!--================ End Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    
    <!--================End Home Banner Area =================-->

    <!--================ Start About Area =================-->
   
    <!--================ End About Area =================-->

    <!--================ Start Feature Area =================-->
    
    <!--================ End Testimonial Area =================-->

    <!--================ Start footer Area  =================-->
    <footer class="footer-area section_gap">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Top Products</h4>
            <ul>
              <li><a href="#">Managed Website</a></li>
              <li><a href="#">Manage Reputation</a></li>
              <li><a href="#">Power Tools</a></li>
              <li><a href="#">Marketing Service</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="#">Jobs</a></li>
              <li><a href="#">Brand Assets</a></li>
              <li><a href="#">Investor Relations</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Features</h4>
            <ul>
              <li><a href="#">Jobs</a></li>
              <li><a href="#">Brand Assets</a></li>
              <li><a href="#">Investor Relations</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Resources</h4>
            <ul>
              <li><a href="#">Guides</a></li>
              <li><a href="#">Research</a></li>
              <li><a href="#">Experts</a></li>
              <li><a href="#">Agencies</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 single-footer-widget">
            <h4>Newsletter</h4>
            <p>You can trust us. we only send promo offers,</p>
            <div class="form-wrap" id="mc_embed_signup">
              <form
                target="_blank"
                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                method="get"
                class="form-inline"
              >
                <input
                  class="form-control"
                  name="EMAIL"
                  placeholder="Your Email Address"
                  onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Your Email Address'"
                  required=""
                  type="email"
                />
                <button class="click-btn btn btn-default">
                  <span>subscribe</span>
                </button>
                <div style="position: absolute; left: -5000px;">
                  <input
                    name="b_36c4fd991d266f23781ded980_aefe40901a"
                    tabindex="-1"
                    value=""
                    type="text"
                  />
                </div>

                <div class="info"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="row footer-bottom d-flex justify-content-between">
          <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
          <div class="col-lg-4 col-sm-12 footer-social">
            <a href="#"><i class="ti-facebook"></i></a>
            <a href="#"><i class="ti-twitter"></i></a>
            <a href="#"><i class="ti-dribbble"></i></a>
            <a href="#"><i class="ti-linkedin"></i></a>
          </div>
        </div>
      </div>
    </footer>
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('theme/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('theme/js/popper.js')}}"></script>
    <script src="{{asset('theme/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('theme/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('theme/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('theme/js/owl-carousel-thumb.min.js')}}"></script>
    <script src="{{asset('theme/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('theme/js/mail-script.js')}}"></script>
    <!--gmaps Js-->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script> -->
    <script src="{{asset('theme/js/gmaps.min.js')}}"></script>
    <script src="{{asset('theme/js/theme.js')}}"></script>
  </body>
</html>
