@extends('layouts.app')
@section('content')
<style>
  .contimg{
    width:80%;
  }
</style>
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
                  Buy and sell quality study notes and resources
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
    <section class="feature_area  mt-4">
      <div class="ma-5">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="main_title">
              <h2 class="mb-3 mt-4">How it works</h2>
             
            </div>
          </div>
        </div>
        <div class="row ">
          <div class="col-lg-4 col-md-6">
            <div class="single_feature bg-white text-center">
              <div class="icon"><i class="fa fa-user fa-4x"></i></div>
              <div class="desc">
                <h3 class="mt-3 mb-2">Sign up</h3>
                <p>
                  Create a free account on Studymerit 
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature bg-white text-center">
              <div class="icon"><i class="fa fa-cloud-upload fa-4x "></i></div>
              <div class="desc">
                <h3 class="mt-3 mb-2">Upload</h3>
                <p>
                  Upload your study guides, summaries, practice questions, lecture notes, assignments, solutions and much more!
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature bg-white text-center">
              <div class="icon"><i class="fa fa-money fa-4x"></i></div>
              <div class="desc">
                <h3 class="mt-3 mb-2">Set a Price</h3>
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

    <section>
      <div class="section bg-white">
        <div class="m-5">
        <div class="row align-items-center">
          <div class="col-md-12 text-center">
          <h1 class="py-4 mb-5 mt-4">Why use Studymerit?</h1>
          </div>
          <div class="col-md-3">
            <h3>Access quality learning materials</h3>
            <p>
            Studymerit provides you with the answers and solutions you require in a wide range of courses, allowing you to learn more quickly and effectively.
            </p>
            <img class="contimg" src="{{asset('theme/img/students.png')}}" alt="">
          </div>
        

        <div class="col-sm-3">
        <img class="contimg" src="{{asset('theme/img/win.png')}}" alt="">
           <h3>Improve your academic performance</h3>
           <p>
           Studymerit is a straightforward and highly effective online tool that assists you in locating the information you require.
           </p>
        </div>

        <div class="col-sm-3">
          <h3>Learn and Earn</h3>
          <p>
          Studymerit is a perfect way to sell & buy study materials  and other class supplements. If you have done well in your classes, and want others to succeed in college. Use Studymerit as an outlet, and get paid at the same time.
          </p>
           <img class="contimg" src="{{asset('theme/img/earn.png')}}" alt="">
        </div>

       <div class="col-sm-3">
       <img class="contimg" src="{{asset('theme/img/access.png')}}" alt="">
         <h3>Convinience</h3>
         <p>
         Why is it difficult to locate a reasonably priced educator or subject matter expert? There is, at long last! Studymerit is a straightforward and highly effective online tool that assists you in locating the information you require.Connect from anywhere at anytime.
         </p>
       </div>

      

      </div>
    </section>
    
    <!--================ End Registration Area =================-->

    <!--================ Start Trainers Area =================-->
  
    <!--================ End Trainers Area =================-->

    <!--================ Start Events Area =================-->
   
    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <div class="testimonial_area section_gap">
      <div class="ma-5">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">What students say about Studymerit</h2>
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
                      As a post graduate student, I believe Studymerit.com provides a great deal of content on the site with an excellent customer service too
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="{{('theme/img/testimonials/t4.png')}}" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Justin mUsk</h4>
                    <p>
                      I got to know of Studymerit from a class mate  who had used the site before, I uploaded my notes from a medical class and within a day, I had sold all but one. The site is quit useful to anyone who has quality class content
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="{{('theme/img/testimonials/t5.png')}}" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Davidson Ford</h4>
                    <p>
                    I think Studymerit is a great way to share your work and help others, while also earning money for your efforts. I believe it's a very useful tool.
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