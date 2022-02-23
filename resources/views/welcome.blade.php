@extends('layouts.app')
@section('content')

    <section class="home_banner_area">
      <div class="banner_inner">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="banner_content text-center">
               
                <h2 class="text-uppercase py-1">
                  Get quality notes in one place
                </h2>
                <p class="font-weight-bold">
                  Access verified materials written by world's best student
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
                Upload and download notes with students and professional learners globally and make money!
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
              <div class="icon"><span class="fa fa-cloud-upload"></span></div>
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
                  Set the price for your notes and wait to sell! You earn money from each document purchased. This money is added to your account instantly.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Feature Area =================-->

    <!--================ Start Popular Courses Area =================-->
   
    <!--================ End Popular Courses Area =================-->

    <!--================ Start Registration Area =================-->
    <div class="section_gap registration_area">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div class="row clock_sec clockdiv" id="clockdiv">
              <div class="col-lg-12">
                <h1 class="mb-3">Why use Study Merit?</h1>
                <p>
                  Keeping students and parents in mind, studymerit.com is conceptualized to consider the importance of time management. Searching through material that you don't need can be a waste of time and effort. Here at Study Merit, you can get straight to the point and find the content you need.
                </p>
              </div>
              <div class="col clockinner1 clockinner">
                <h1 class="days">+150K</h1>
                <span class="smalltext">uploads</span>
              </div>
              <div class="col clockinner clockinner1">
                <h1 class="hours">+13K</h1>
                <span class="smalltext">downloads</span>
              </div>
              <div class="col clockinner clockinner1">
                <h1 class="minutes">+2.5K</h1>
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
  
    <!--================ End Trainers Area =================-->

    <!--================ Start Events Area =================-->
   
    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <div class="testimonial_area section_gap">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">What users are saying</h2>
              <p>
                
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="testi_slider owl-carousel">
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="{{asset('theme/img/testimonials/t3.jpg')}}" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Elite Martin</h4>
                    <p>
                      The site is so easy to use. The design and usability makes it easy to upload notes to share with new professionals an make money from it too!
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="{{asset('theme/img/testimonials/t4.png')}}" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Davil Saden</h4>
                    <p>
                      As a post graduate student, I believe Stydymerit.com provides a great deal of content on the site with an excellent customer service too
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="{{('theme/img/testimonials/t1.jpg')}}" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Justin mUsk</h4>
                    <p>
                      I got to know of Study Merit from a class mate  who had used the site before, I uploaded my notes from a medical class and within a day, I had sold all but one. The site is quit useful to anyone who has quality class content
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