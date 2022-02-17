@extends('layouts.app')
@section('content')

    <section class="home_banner_area">
      <div class="banner_inner">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="banner_content text-center">
               
                <h2 class="text-uppercase py-1">
                  One Step Ahead This Season
                </h2>
                <p class="text-uppercase">
                  Best online education service In the world
                </p>
                <div class="">
                <div class="search"> 
                  <i class="fa fa-search"></i>
                  <form action="{{route('search')}}" method="get">
                  
                   <input type="text" name="search_text" class="form-control" placeholder="Quick search? title, decription, author...">
                   <button type="submit" class="genric-btn primary radius"><i class="fa fa-search"></i>Search</button>
                 </form>
                   
                </div>
                </div>
                <!-- <div>
                 
                  <a href="{{url('upload')}}" class="primary-btn2 mb-3 mb-sm-0">Sell</a>
                  <a href="{{url('browse-files')}}" class="primary-btn ml-sm-3 ml-0">Browse</a>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Start Feature Area =================-->
    <section class="feature_area section_gap_top">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="main_title">
              <h2 class="mb-3">How it works</h2>
              <p>
                If you've got good notes from any college or university around the world, then Study Merit is the BEST place to sell them and make passive income through work you've already done. 
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="fa fa-user"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Sign up</h4>
                <p>
                  Create a free account on Study merit 
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-book"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Upload</h4>
                <p>
                  Upload your study guides, summaries, practice questions, lecture notes, assignments, solutions and much more!
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="fa fa-money"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Set a Price</h4>
                <p>
                  Set the price for your notes and wait to sell! You earn money from each document you sell. This money is added to your account instantly.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Feature Area =================-->

    <!--================ Start Popular Courses Area =================-->
    <div class="popular_courses">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Our Popular Downloads </h2>
              <p>
            The most popular uploads are listed below:
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- single course -->

        
          <div class="col-lg-12">
            <div class="owl-carousel active_course">
            @foreach($uploads as $upload)
              <div class="single_course" >
                <div class="course_head">
                <img class="img-fluid" style="height:220px" src="{{$upload->image}}" alt="" />
                </div>
                <div class="course_content">
                  <span class="price">${{number_format($upload->price,2)}}</span>
                  <span class="tag mb-4 d-inline-block">{{$upload->sname}}</span>
                  <h4 class="mb-3">
                    <a href="{{url('document-preview/'.$upload->slug)}}">{{$upload->title}}</a>
                  </h4>
                  
                  <div
                    class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4"
                  >
                    
                    <div class="mt-lg-0 mt-3">
                      <span class="meta_info mr-4 font-bold">
                        <a href="#"> <i class="ti-download"></i> downloads ({{$upload-> count_click}}) </a>
                      </span>
                      
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              

         
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ End Popular Courses Area =================-->

    <!--================ Start Registration Area =================-->
    <div class="section_gap registration_area">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div class="row clock_sec clockdiv" id="clockdiv">
              <div class="col-lg-12">
                <h1 class="mb-3">Register Now</h1>
                <p>
                It's simple and straightforward to make extra cash as a student, just upload your notes to us and we'll handle the sales side and pass the money back to you. Docmerit offers the highest payout ratio: you earn up to 85% per sale. We transfer the money to your bank account within 24 working hours. Sign up for free today and start earning while helping other fellow students!
                </p>
              </div>
              <div class="col clockinner1 clockinner">
                <h1 class="days">150</h1>
                <span class="smalltext">uploads</span>
              </div>
              <div class="col clockinner clockinner1">
                <h1 class="hours">23</h1>
                <span class="smalltext">downloads</span>
              </div>
              <div class="col clockinner clockinner1">
                <h1 class="minutes">47</h1>
                <span class="smalltext">users</span>
              </div>
             
            </div>
          </div>
          <div class="col-lg-4 offset-lg-1">
            <img src="{{asset('theme/img/banner/free.png')}}" alt="">
            
          </div>
        </div>
      </div>
    </div>
    <!--================ End Registration Area =================-->

    <!--================ Start Trainers Area =================-->
    <section class="trainer_area section_gap_top">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Our Expert Trainers</h2>
              <p>
                Replenish man have thing gathering lights yielding shall you
              </p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
          <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
            <div class="thumb d-flex justify-content-sm-center">
              <img class="img-fluid" src="img/trainer/t1.jpg" alt="" />
            </div>
            <div class="meta-text text-sm-center">
              <h4>Mated Nithan</h4>
              <p class="designation">Sr. web designer</p>
              <div class="mb-4">
                <p>
                  If you are looking at blank cassettes on the web, you may be
                  very confused at the.
                </p>
              </div>
              <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="ti-facebook"></i></a>
                <a href="#"><i class="ti-twitter"></i></a>
                <a href="#"><i class="ti-linkedin"></i></a>
                <a href="#"><i class="ti-pinterest"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
            <div class="thumb d-flex justify-content-sm-center">
              <img class="img-fluid" src="img/trainer/t2.jpg" alt="" />
            </div>
            <div class="meta-text text-sm-center">
              <h4>David Cameron</h4>
              <p class="designation">Sr. web designer</p>
              <div class="mb-4">
                <p>
                  If you are looking at blank cassettes on the web, you may be
                  very confused at the.
                </p>
              </div>
              <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="ti-facebook"></i></a>
                <a href="#"><i class="ti-twitter"></i></a>
                <a href="#"><i class="ti-linkedin"></i></a>
                <a href="#"><i class="ti-pinterest"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
            <div class="thumb d-flex justify-content-sm-center">
              <img class="img-fluid" src="img/trainer/t3.jpg" alt="" />
            </div>
            <div class="meta-text text-sm-center">
              <h4>Jain Redmel</h4>
              <p class="designation">Sr. Faculty Data Science</p>
              <div class="mb-4">
                <p>
                  If you are looking at blank cassettes on the web, you may be
                  very confused at the.
                </p>
              </div>
              <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="ti-facebook"></i></a>
                <a href="#"><i class="ti-twitter"></i></a>
                <a href="#"><i class="ti-linkedin"></i></a>
                <a href="#"><i class="ti-pinterest"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
            <div class="thumb d-flex justify-content-sm-center">
              <img class="img-fluid" src="img/trainer/t4.jpg" alt="" />
            </div>
            <div class="meta-text text-sm-center">
              <h4>Nathan Macken</h4>
              <p class="designation">Sr. web designer</p>
              <div class="mb-4">
                <p>
                  If you are looking at blank cassettes on the web, you may be
                  very confused at the.
                </p>
              </div>
              <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="ti-facebook"></i></a>
                <a href="#"><i class="ti-twitter"></i></a>
                <a href="#"><i class="ti-linkedin"></i></a>
                <a href="#"><i class="ti-pinterest"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Trainers Area =================-->

    <!--================ Start Events Area =================-->
    <div class="events_area">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3 text-white">Upcoming Events</h2>
              <p>
                Replenish man have thing gathering lights yielding shall you
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="single_event position-relative">
              <div class="event_thumb">
                <img src="img/event/e1.jpg" alt="" />
              </div>
              <div class="event_details">
                <div class="d-flex mb-4">
                  <div class="date"><span>15</span> Jun</div>

                  <div class="time-location">
                    <p>
                      <span class="ti-time mr-2"></span> 12:00 AM - 12:30 AM
                    </p>
                    <p>
                      <span class="ti-location-pin mr-2"></span> Hilton Quebec
                    </p>
                  </div>
                </div>
                <p>
                  One make creepeth man for so bearing their firmament won't
                  fowl meat over seas great
                </p>
                <a href="#" class="primary-btn rounded-0 mt-3">View Details</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="single_event position-relative">
              <div class="event_thumb">
                <img src="img/event/e2.jpg" alt="" />
              </div>
              <div class="event_details">
                <div class="d-flex mb-4">
                  <div class="date"><span>15</span> Jun</div>

                  <div class="time-location">
                    <p>
                      <span class="ti-time mr-2"></span> 12:00 AM - 12:30 AM
                    </p>
                    <p>
                      <span class="ti-location-pin mr-2"></span> Hilton Quebec
                    </p>
                  </div>
                </div>
                <p>
                  One make creepeth man for so bearing their firmament won't
                  fowl meat over seas great
                </p>
                <a href="#" class="primary-btn rounded-0 mt-3">View Details</a>
              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="text-center pt-lg-5 pt-3">
              <a href="#" class="event-link">
                View All Event <img src="img/next.png" alt="" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <div class="testimonial_area section_gap">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Client say about me</h2>
              <p>
                Replenish man have thing gathering lights yielding shall you
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="testi_slider owl-carousel">
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/t1.jpg" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Elite Martin</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/t2.jpg" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Davil Saden</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/t1.jpg" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Elite Martin</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/t2.jpg" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Davil Saden</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/t1.jpg" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Elite Martin</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/t2.jpg" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Davil Saden</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection