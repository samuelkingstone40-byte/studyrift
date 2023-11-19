@extends('layouts.default')
@section('content')

<section class="bg-gray-50 h-full mt-10" id="contact">
  <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
      <div class="mb-2">
          <div class="mb-2 max-w-3xl text-center sm:text-center md:mx-auto md:mb-12">
              
              <h2
                  class="font-heading mb-4 font-bold tracking-tight text-gray-900 dark:text-white text-3xl sm:text-5xl">
                  Get in Touch
              </h2>
              
          </div>
      </div>
   
      <div class="flex items-stretch justify-center ">
          <div class="grid md:grid-cols-2 gap-4">
              <div class="h-full pr-6">
                <div class="lg:ml-6 lg:col-start-2 lg:max-w-2xl">
                  <p class="text-base font-semibold leading-6 text-indigo-500 uppercase">
                    Please get in touch with us
                  </p>
                
              
                  <ul class="mt-8 space-y-3 font-medium">
                    <li class="flex items-start lg:col-span-1">
                      <div class="flex-shrink-0">
                          <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                  clip-rule="evenodd"></path>
                          </svg>
                      </div>
                      <p class="ml-3 leading-5 text-gray-600">
                        Get in touch with us if you have any general queries or issues
                      </p>
                  </li>
                      <li class="flex items-start lg:col-span-1">
                          <div class="flex-shrink-0">
                              <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                              </svg>
                          </div>
                          <p class="ml-3 leading-5 text-gray-600">
                            Notify authorities if there is any suspicious activity.
                          </p>
                      </li>
                      <li class="flex items-start lg:col-span-1">
                          <div class="flex-shrink-0">
                              <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                              </svg>
                          </div>
                          <p class="ml-3 leading-5 text-gray-600">
                            Complain about cheating
                          </p>
                      </li>
                      <li class="flex items-start lg:col-span-1">
                          <div class="flex-shrink-0">
                              <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"></path>
                              </svg>
                          </div>
                          <p class="ml-3 leading-5 text-gray-600">
                            File a copyright complaint
                          </p>
                      </li>

                  </ul>
              </div>
              </div>
              <div class="card h-fit max-w-6xl " id="form">
                  <h2 class="mb-4 text-2xl font-bold">Do you have an issue or a question?</h2>
                  <form id="contactForm">
                      <div class="mb-6">
                          <div class="mx-0 mb-1 sm:mb-4">
                              <div class="mx-0 mb-1 sm:mb-4">
                                  <label for="name" class="pb-1 text-xs uppercase tracking-wider"></label><input type="text" id="name" autocomplete="given-name" placeholder="Your name" class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0" name="name">
                              </div>
                              <div class="mx-0 mb-1 sm:mb-4">
                                  <label for="email" class="pb-1 text-xs uppercase tracking-wider"></label><input type="email" id="email" autocomplete="email" placeholder="Your email address" class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0" name="email">
                              </div>
                          </div>
                          <div class="mx-0 mb-1 sm:mb-4">
                              <label for="textarea" class="pb-1 text-xs uppercase tracking-wider"></label><textarea id="textarea" name="textarea" cols="30" rows="5" placeholder="Write your message..." class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0"></textarea>
                          </div>
                      </div>
                      <div class="text-center">
                          <button type="submit" class="w-full bg-blue-800 text-white px-6 py-3 font-xl rounded-md sm:mb-0">Send Message</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</section>

@endsection