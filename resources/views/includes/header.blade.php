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
            @guest
            <a class="navbar-brand" href="{{url('/')}}">
              <img class="logo-2" src="{{asset('theme/img/logo2.png')}}" alt="" />
            </a>
            @else
            <a class="navbar-brand" href="{{url('home')}}">
              <img class="logo-2" src="{{asset('theme/img/logo2.png')}}" alt="" />
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
            <div
              class="collapse navbar-collapse offset"
              id="navbarSupportedContent"
            >

         


              <ul class="nav navbar-nav menu_nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link" href="{{url('upload')}}">Sell Documents</a>
                </li>
                <li class="nav-link">
                <div class="dropdown">
                <a class="nav-link" style="color:white;font:700"  data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger ml-1">{{ count((array) session('cart')) }}</span>
                      </a>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            <div class="col-lg-6 col-sm-6 col-6">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
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
                                    <div  id="my_pdf_viewer" >
                       <div class="myClass" id="companyInfo" >
                       <input  type="hidden"  id="file" value="{{$details['image']}}">
                            <canvas   id="pdf_renderer{{$loop->index}}" style="max-width:100%"></canvas>
                        </div>
                       </div>
                                    
                                    
                                   
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
                                <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                            </div>
                        </div>
                    </div>
                </div>

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
                 <div class="dropdown-list-image mr-3">
                   
                 <img class="rounded-circle" src="{{asset('theme/img/testimonials/t1.jpg')}}" alt="">
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
    @section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
<script>

var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
$('#companyInfo input').each(function ( value,index) {
    var filename=$(this).val()
    console.log(filename)
    pdfjsLib.getDocument("{{asset('files')}}/"+ filename).then((pdf) => {
        myState.pdf = pdf;
        render();
    });
    function render() {
        myState.pdf.getPage(myState.currentPage).then((page) => {
     
            var canvas = document.getElementById("pdf_renderer"+ value);
            var ctx = canvas.getContext('2d');
 
            var viewport = page.getViewport(myState.zoom);

            canvas.width = viewport.width;
            canvas.height = viewport.height;
     
            page.render({
                canvasContext: ctx,
                viewport: viewport
            });
        });
    }
});
        
    
    </script>
 
@endsection