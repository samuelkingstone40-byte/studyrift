@extends('layouts.default')

@section('content')
<section class="bg-center  bg-no-repeat bg-[url('/theme/img/site/banner2.jpg')] bg-gray-600 bg-blend-multiply bg-cover">
    <div class="px-4 mx-auto  max-w-screen-xl text-center py-48 lg:py-56">
        <h1 class="mb-4  font-extrabold tracking-tight leading-none text-white text-xl md:text-3xl lg:text-4xl">GET QUALITY NOTES IN ONE PLACE</h1>
        <p class="mb-8  font-normal text-gray-300 text-lg lg:text-2xl sm:px-16 lg:px-48">Find study materials, textbooks and other study instruments for all subjects.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href={{route('login')}} class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Login
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            <a href="{{url('/search')}}" class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                Browse For Materials
            </a>  
        </div>
  
      
    </div>
  </section>
  <section class="bg-slate-50 ">
    <div class="px-4 mx-auto  py-4 max-w-screen-xl text-center">
    <div class="my-4">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight mb-4">
      Find study resources<br class="block sm:hidden" />
      <span class="text-yellow-300">or share your notes</span>
    </h1>
     
      <div class="text-lg sm:text-xl opacity-90 mb-6">Access a variety of study materials to help with your academic success</div>
    </div>
    <div class="my-2">
      <div class="mx-auto relative">
        <input type="text" autocomplete="off" id="search_text2"
          class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-12 p-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Search notes, exams,...">
        <div id="dropdown-search2" class="z-10 hidden absolute w-full left-0 bg-white px-4 mt-2 py-2 border border-gray-300 rounded shadow max-h-60 overflow-y-auto">
          <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 space-y-1" aria-labelledby="dropdown-button" id="results2">
        </div>
      </div>
    </div>
    <div>
      <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($categories as $category )
          <a href="{{route('search', ['category' => 3])}}" class="bg-gray-50 p-4 hover:bg-blue-200 text-center border rounded font-semibold text-gray-600">{{$category->name}}</a>
        @endforeach
      </div>
    </div>
    </div>
  </section>

  <section >
    <div class="px-6 mx-auto text-center py-10  max-w-screen-xl">
      <h1 class="font-bold text-2xl md:text-4xl py-2 mb-4">
        WELCOME TO THE LARGEST ONLINE STUDY RESOURCES PLATFORM
      </h1>
      <p class="text-gray-500 leading-10 text-lg md:text-xl ">
        We're a small team dedicated to this goal and we've worked hard on building, testing, refining and then launching the tool you are looking at today. We hope you enjoy using it as much as we enjoyed creating it.
      </p>
      <div class="text-center mt-5  px-4 bg-white rounded-lg md:px-8 dark:bg-gray-800" id="stats" role="tabpanel" aria-labelledby="stats-tab">
        <dl class="grid max-w-screen-xl grid-cols-1 gap-8 p-4 mx-auto text-gray-900 md:grid-cols-3 xl:grid-cols-3 dark:text-white sm:p-8">
            <div class="flex flex-col items-center justify-center">
                <dt class="mb-2 text-2xl mb:text-4xl font-extrabold">73M+</dt>
                <dd class="text-gray-500 dark:text-gray-400">Study Materials</dd>
            </div>
            <div class="flex flex-col items-center justify-center">
                <dt class="mb-2 text-2xl mb:text-4xl font-extrabold">100M+</dt>
                <dd class="text-gray-500 dark:text-gray-400">Downloads</dd>
            </div>
            <div class="flex flex-col items-center justify-center">
                <dt class="mb-2 text-2xl mb:text-4xl font-extrabold">1000s</dt>
                <dd class="text-gray-500 dark:text-gray-400">Students</dd>
            </div>
            
            
        </dl>
    </div>
    </div>
  </section>

  <section class="bg-slate-50">
    <div class="px-8 mx-auto py-5 lg:py-10">

      <h1 class="text-2xl py-2 mb:py-4 md:mb-6 text-center md:text-3xl font-bold">HOW IT WORKS</h1>
      <div class="md:flex md:flex-row">
        <div class="basis-0 md:basis-1/3">
          <div class="py-4 text-lg md:text-2xl font-semibold">Follow the following easy steps</div>
          <ul class="list-disc pl-4">
            <li class="text-md md:text-xl pb-4">Access Unlimited Materials</li>
            <li class="text-md md:text-xl pb-4">Upload own materials</li>
            <li class="text-md md:text-xl pb-4">Earn from your uploads</li>
          </ul>
        </div>
      
        <div class="basis-0 md:basis-2/3">
        <div class="bg-white rounded-lg px-20 py-12">
          
          <ol class="relative border-s border-gray-200 dark:border-gray-700">                  
            <li class="mb-24 md:mb-40 ms-10 md:ms-16">
              <div class=""></div>            
                <span class="absolute flex items-center justify-center w-14 md:w-24 h-14 md:h-24 bg-white rounded-full -start-8 md:-start-12 ring-1 ring-blue-300 dark:ring-gray-900 dark:bg-blue-900">
                  <img class="h-10 md:h-12" src="{{asset('theme/img/site/signup.jpg')}}" alt="">
                </span>
              
                  <h3 class="flex items-start  text-xl font-semibold text-gray-900 dark:text-white">Sign Up </h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Create an account for free.</p>
                  
            </li>
            <li class="mb-24 md:mb-40 ms-10 md:ms-16">
              <div class=""></div>            
                <span class="absolute flex items-center justify-center  w-14 md:w-24 h-14 md:h-24 bg-white rounded-full -start-8 md:-start-12 ring-1 ring-blue-900 dark:ring-gray-900 dark:bg-blue-900">
                  <img class="h-10 md:h-12" src="{{asset('theme/img/site/upload-files.jpg')}}"  alt="">
                </span>
              
                <h3 class="flex items-start pb-2 text-xl font-semibold text-gray-900 dark:text-white">Upload Notes</h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Upload your study guides, summaries, practice questions, lecture notes, assignments, solutions and much more!</p>
                  
            </li>

            <li class="ms-10 md:ms-16">
              <div class=""></div>            
                <span class="absolute flex items-center justify-center  w-14 md:w-24 h-14 md:h-24 bg-white rounded-full -start-8 md:-start-12 ring-1 ring-blue-900 dark:ring-gray-900 dark:bg-blue-900">
                  <img class="h-10 md:h-12" src="{{asset('theme/img/site/earn.png')}}" alt="">
                </span>
              
                  <h3 class="flex items-start  text-xl font-semibold text-gray-900 dark:text-white">Set a Price </h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Set the price for your notes and wait to earn from each download.</p>
                  
            </li>

          </ol>


        </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white">
    <div class="px-8 mx-auto  max-w-screen  py-5 lg:py-10">
      <h1 class="text-2xl text-center md:text-3xl font-bold py-6">Get Great Study Materials and Great Services</h1>

      <div class="space-y-8 md:grid md:grid-cols-4 my-6 lg:grid-cols-4 md:gap-12 md:space-y-0">
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="flex mb-2 justify-center items-center">
            <img class="img-fluid h-24 md:h-32" src="{{asset('theme/img/site/graduation.png')}}" alt="">
          </div>

          
          <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Learn with experts</h5>
          <p class="mb-3 font-normal text-lg text-gray-500 dark:text-gray-400">Get high quality, verified notes from your school, professional course, or university.</p>
        </div>

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="flex mb-2 justify-center items-center">
            <img class="img-fluid h-24 md:h-32" src="{{asset('theme/img/site/books.png')}}" alt="">
          </div>

          
          <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Learn anything</h5>
          <p class="mb-3 font-normal text-lg text-gray-500 dark:text-gray-400">Buy lecture notes, summaries and practice exams and get higher grades for your exams.</p>
        </div>

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="flex mb-2 justify-center items-center">
            <img class="img-fluid h-24 md:h-32" src="{{asset('theme/img/site/clock.png')}}" alt="">
          </div>

          
          <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Flexible learning</h5>
          <p class="mb-3 font-normal text-lg text-gray-500 dark:text-gray-400">Summaries and study guides and tests are 24/7 online available.</p>
        </div>

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="flex mb-2 justify-center items-center">
            <img class="img-fluid h-24 md:h-32" src="{{asset('theme/img/site/calendar.png')}}" alt="">
          </div>
          <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Individual plans</h5>
          <p class="mb-3 font-normal text-lg text-gray-500 dark:text-gray-400">Make money selling your course notes while helping others learn.</p>
        </div>
        
        
    </div>
    </div>
  </section>

  <section class="bg-slate-50">
    <div id="default-carousel" class="relative w-full py-4" data-carousel="slide">
      <!-- Carousel wrapper -->
      <div class="relative mb-10 h-56 overflow-hidden rounded-lg md:h-96">
          <!-- Item 1 -->
          <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
              <figure class="max-w-screen-md mx-auto">
                  <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor"/>
                  </svg> 
                  <blockquote>
                      <p class="text-lg mb:text-2xl font-medium text-gray-900 dark:text-white">"The site is so easy to use. The design and usability makes it easy to upload notes to share with new professionals an make money from it too!"</p>
                  </blockquote>
                  <figcaption class="flex items-center justify-center mt-6 space-x-3">
                      <img class="w-6 h-6 rounded-full" src="{{asset('theme/img/testimonials/t3.jpg')}}" alt="profile picture">
                      <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                          <div class="pr-3 font-medium text-gray-900 dark:text-white">Elite Martin</div>
                          <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">Student at Stanford </div>
                      </div>
                  </figcaption>
              </figure>
            </div>
          </div>
          <!-- Item 2 -->
          <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
              <figure class="max-w-screen-md mx-auto">
                  <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor"/>
                  </svg> 
                  <blockquote>
                      <p class="text-lg mb:text-2xl font-medium text-gray-900 dark:text-white">"As a post graduate student, I believe StudyRift.com provides a great deal of content on the site with an excellent customer service too
                        "</p>
                  </blockquote>
                  <figcaption class="flex items-center justify-center mt-6 space-x-3">
                      <img class="w-6 h-6 rounded-full" src="{{asset('theme/img/testimonials/t4.png')}}" alt="profile picture">
                      <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                          <div class="pr-3 font-medium text-gray-900 dark:text-white">Davil Saden</div>
                          <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">Ms Student in UK</div>
                      </div>
                  </figcaption>
              </figure>
          </div>
          </div>
          <!-- Item 3 -->
          <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
              <figure class="max-w-screen-md mx-auto">
                  <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor"/>
                  </svg> 
                  <blockquote>
                      <p class="text-lg mb:text-2xl font-medium text-gray-900 dark:text-white">"I got to know of studyrift from a class mate who had used the site before, I uploaded my notes from a medical class and within a day, I had sold all but one. The site is quit useful to anyone who has quality class content."</p>
                  </blockquote>
                  <figcaption class="flex items-center justify-center mt-6 space-x-3">
                      <img class="w-6 h-6 rounded-full" src="{{('theme/img/testimonials/t4.png')}}" alt="profile picture">
                      <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                          <div class="pr-3 font-medium text-gray-900 dark:text-white">Justin musk</div>
                          <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">Student</div>
                      </div>
                  </figcaption>
              </figure>
          </div>
          </div>
          <!-- Item 4 -->
          <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
              <figure class="max-w-screen-md mx-auto">
                  <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor"/>
                  </svg> 
                  <blockquote>
                      <p class="text-lg mb:text-2xl font-medium text-gray-900 dark:text-white">"I think studyrift is a great way to share your work and help others, while also earning money for your efforts. I believe it's a very useful tool."</p>
                  </blockquote>
                  <figcaption class="flex items-center justify-center mt-6 space-x-3">
                      <img class="w-6 h-6 rounded-full" src="{{('theme/img/testimonials/t5.png')}}" alt="profile picture">
                      <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                          <div class="pr-3 font-medium text-gray-900 dark:text-white">Davidson Ford</div>
                          <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">Lecturer Ghana</div>
                      </div>
                  </figcaption>
              </figure>
          </div>
          </div>

      </div>
      <!-- Slider indicators -->
      <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
          <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
          <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
          <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
          <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
      </div>
      <!-- Slider controls -->
      <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
          <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
              <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
              </svg>
              <span class="sr-only">Previous</span>
          </span>
      </button>
      <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
          <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
              <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <span class="sr-only">Next</span>
          </span>
      </button>
    </div>

  </section>

@endsection
@section('scripts')
    <script type="text/javascript">
      $(document).ready(function(){
        $('#search_text2').on('keyup',function(){
          var query=$(this).val();
          if(query.length>0){
            $.ajax({
              type:'get',
              url:'{{route('search_files') }}',
              data:{'search':query},
              success:function(data){
                 var dropdown = $('#dropdown-search2');
                 dropdown.show();
                 $('#results2').html(data)
              }
            })
          } 
        })
      })
    </script>

    @endsection