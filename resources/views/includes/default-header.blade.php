
    <nav class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
      <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">
         
            <a href={{url('/')}} class="flex items-center justify-between mr-4">
                <img
                src={{asset('/theme/img/site/logo.png')}}
                class="mr-3 h-6 md:h-8"
                alt="Studymerit Logo"
                />
            </a>
            <form class="md:flex items-center hidden mt-2 md:pl-2" action="{{route('search')}}"  method="get">   
              
                <div class="relative w-96">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-6 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z"/>
                        </svg>
                    </div>
                    <input type="text"  name="search_text" id="voice-search" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-12 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search notes, exams,..." >
                   
                </div>
                <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>Search
                </button>
            </form>
        </div>
        <div class="flex items-center gap-4 lg:order-2">
          @guest
            <div class="flex justify-center gap-4" >
                <a href="{{url('login')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm   md:text-lg px-4 py-1 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>
                <a href="{{url('register')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm  md:text-lg px-4 py-1 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</a>
            </div>
          
          @else
          <button
          type="button"
          data-drawer-toggle="drawer-navigation"
          aria-controls="drawer-navigation"
          class="p-2 mr-1 text-gray-500 rounded-lg md:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
              <span class="sr-only">Toggle search</span>
              <svg aria-hidden="true" class="w-6 h-6 md:w-8 md:h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path clip-rule="evenodd" fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"></path>
              </svg>
        </button>
          @if(count((array) session('cart'))>0)
          <div class="flex items-center ml-4">
              <div>
                  <button type="button" class="flex text-lg " aria-expanded="false" data-dropdown-toggle="dropdown-cart">
                      <span class="sr-only">Open user menu</span>
                      <svg class="w-6 h-6 md:w-8 md:h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                      </svg>
                  </button>
                  <span class="sr-only">Orders</span>
                  <div class="absolute inline-flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-0 ml-4  dark:border-gray-900">
                      {{ count((array) session('cart')) }}
                  </div>
                  
              </div>
          

              <div class="z-50 w-96 hidden my-6  text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-cart">
                  <div class="px-4 py-3 border border-gray-100" role="none">
                      <div class="flex justify-between py-2 text-lg text-gray-600 font-semibold">
                          <div class=""> 
                              Items ( {{ count((array) session('cart')) }} )
                          </div>
                          <div >
                              @php $total = 0 @endphp
                              @foreach((array) session('cart') as $id => $details)
                                  @php $total += $details['price'] * $details['quantity'] @endphp
                              @endforeach
                              Total : <span class="text-red-600">${{ $total }}</span>
                          </div>
                      </div>
                      <hr/>

                      @if(session('cart'))
                      <table class="w-full border border-gray-300 p-4">
                        <thead>
                            <tr>
                                <th class="text-left text-sm font-semibold p-4">Product</th>
                                <th class="text-left text-sm font-semibold">Price</th>
                            </tr>
                        </thead>
                        <tbody class="border border-gray-300 p-2">
                            @foreach(session('cart') as $id => $details)
                                <tr class="mx-2">
                                    <td class="text-xs p-4 line-clamp-1 border border-gray-100">{{ $details['name'] }}</td>
                                    <td class="text-xs p-4 ">
                                        ${{ $details['price'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                          <div class="my-4">
                              <div class="text-right">
                                  <a href="{{ route('checkout') }}" class="w-full rounded border border-gray-300 bg-green-400 p-2 text-white">Checkout</a>
                              </div>
                          </div>
                      @endif
             
                  </div>
              </div>
          </div>
      @endif

        
          <button
            type="button"
            data-dropdown-toggle="apps-dropdown"
            class="p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
            <span class="sr-only">View notifications</span>
            <!-- Icon -->
            <svg class="w-6 h-6 md:w-8 md:h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 21">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C15 15.4 15 16 14.462 16H1.538C1 16 1 15.4 1 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 8 3.464ZM4.54 16a3.48 3.48 0 0 0 6.92 0H4.54Z"/>
              </svg>
          </button>
          <!-- Dropdown menu -->
          <div
            class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
            id="apps-dropdown">
            <div
              class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-600 dark:text-gray-300"
            >
              Notifications
            </div>
            
            
          </div>

          <button
            type="button"
            class="flex  text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            id="user-menu-button"
            aria-expanded="false"
            data-dropdown-toggle="dropdown">
            <span class="sr-only">Open user menu</span>
            <svg class="w-6 h-6 md:w-8 md:h-8 bg-white text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 19a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 11 14H9a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 10 19Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
              </svg>
          </button>
          <!-- Dropdown menu -->
          <div
            class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
            id="dropdown">
            <div class="py-3 px-4">
              <span
                class="block text-sm font-semibold text-gray-900 dark:text-white"
                >{{auth()->user()->name}}</span
              >
              <span
                class="block text-sm text-gray-900 truncate dark:text-white"
                >{{auth()->user()->email}}</span
              >
            </div>
          
            <ul
              class="py-1 text-gray-700 dark:text-gray-300"
              aria-labelledby="dropdown"
            >
            <li>
                <a
                  href={{url('home')}}
                  class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  <svg class="w-5 h-5 mr-2 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8v10a1 1 0 0 0 1 1h4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5h4a1 1 0 0 0 1-1V8M1 10l9-9 9 9"/>
                  </svg>
                  Dashboard</a
                >
              </li>
            <li>
                <a
                  href={{url('profile')}}
                  class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                  >
                  <svg class="w-5 h-5 mr-2 text-gray-400 dark:text-white" aria-hidden="true" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.5 8C5.80777 8 5.13108 7.79473 4.55551 7.41015C3.97993 7.02556 3.53133 6.47893 3.26642 5.83939C3.00152 5.19985 2.9322 4.49612 3.06725 3.81719C3.2023 3.13825 3.53564 2.51461 4.02513 2.02513C4.51461 1.53564 5.13825 1.2023 5.81719 1.06725C6.49612 0.932205 7.19985 1.00152 7.83939 1.26642C8.47893 1.53133 9.02556 1.97993 9.41015 2.55551C9.79473 3.13108 10 3.80777 10 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.5 17H1V15C1 13.9391 1.42143 12.9217 2.17157 12.1716C2.92172 11.4214 3.93913 11 5 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19.5 11H18.38C18.2672 10.5081 18.0714 10.0391 17.801 9.613L18.601 8.818C18.6947 8.72424 18.7474 8.59708 18.7474 8.4645C18.7474 8.33192 18.6947 8.20476 18.601 8.111L17.894 7.404C17.8002 7.31026 17.6731 7.25761 17.5405 7.25761C17.4079 7.25761 17.2808 7.31026 17.187 7.404L16.392 8.204C15.9647 7.93136 15.4939 7.73384 15 7.62V6.5C15 6.36739 14.9473 6.24021 14.8536 6.14645C14.7598 6.05268 14.6326 6 14.5 6H13.5C13.3674 6 13.2402 6.05268 13.1464 6.14645C13.0527 6.24021 13 6.36739 13 6.5V7.62C12.5081 7.73283 12.0391 7.92863 11.613 8.199L10.818 7.404C10.7242 7.31026 10.5971 7.25761 10.4645 7.25761C10.3319 7.25761 10.2048 7.31026 10.111 7.404L9.404 8.111C9.31026 8.20476 9.25761 8.33192 9.25761 8.4645C9.25761 8.59708 9.31026 8.72424 9.404 8.818L10.204 9.618C9.9324 10.0422 9.73492 10.5096 9.62 11H8.5C8.36739 11 8.24021 11.0527 8.14645 11.1464C8.05268 11.2402 8 11.3674 8 11.5V12.5C8 12.6326 8.05268 12.7598 8.14645 12.8536C8.24021 12.9473 8.36739 13 8.5 13H9.62C9.73283 13.4919 9.92863 13.9609 10.199 14.387L9.404 15.182C9.31026 15.2758 9.25761 15.4029 9.25761 15.5355C9.25761 15.6681 9.31026 15.7952 9.404 15.889L10.111 16.596C10.2048 16.6897 10.3319 16.7424 10.4645 16.7424C10.5971 16.7424 10.7242 16.6897 10.818 16.596L11.618 15.796C12.0422 16.0676 12.5096 16.2651 13 16.38V17.5C13 17.6326 13.0527 17.7598 13.1464 17.8536C13.2402 17.9473 13.3674 18 13.5 18H14.5C14.6326 18 14.7598 17.9473 14.8536 17.8536C14.9473 17.7598 15 17.6326 15 17.5V16.38C15.4919 16.2672 15.9609 16.0714 16.387 15.801L17.182 16.601C17.2758 16.6947 17.4029 16.7474 17.5355 16.7474C17.6681 16.7474 17.7952 16.6947 17.889 16.601L18.596 15.894C18.6897 15.8002 18.7424 15.6731 18.7424 15.5405C18.7424 15.4079 18.6897 15.2808 18.596 15.187L17.796 14.392C18.0686 13.9647 18.2662 13.4939 18.38 13H19.5C19.6326 13 19.7598 12.9473 19.8536 12.8536C19.9473 12.7598 20 12.6326 20 12.5V11.5C20 11.3674 19.9473 11.2402 19.8536 11.1464C19.7598 11.0527 19.6326 11 19.5 11ZM14 14.5C13.5055 14.5 13.0222 14.3534 12.6111 14.0787C12.2 13.804 11.8795 13.4135 11.6903 12.9567C11.5011 12.4999 11.4516 11.9972 11.548 11.5123C11.6445 11.0273 11.8826 10.5819 12.2322 10.2322C12.5819 9.8826 13.0273 9.6445 13.5123 9.54804C13.9972 9.45157 14.4999 9.50108 14.9567 9.6903C15.4135 9.87952 15.804 10.2 16.0787 10.6111C16.3534 11.0222 16.5 11.5055 16.5 12C16.5 12.663 16.2366 13.2989 15.7678 13.7678C15.2989 14.2366 14.663 14.5 14 14.5Z" fill="currentColor"/>
                    </svg>
                    
                  Manage Account</a
                >
              </li>
              <li>
                <a
                  href={{url('uploads')}}
                  class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                  >
                  <svg class="w-5 h-5 text-gray-400 mr-2 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3m-5.5 0V1.07M5.5 5l4-4 4 4"/>
                  </svg>
                  My Uploads</a
                >
              </li>
              <li>
                <a
                  href={{url('downloads')}}
                  class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                  >
                  <svg class="w-5 h-5 mr-2 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                  </svg>
                  My Downloads</a
                >
              </li>
             
            
            </ul>
            <ul
              class="py-1 text-gray-700 dark:text-gray-300"
              aria-labelledby="dropdown"
            >
              <li>
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
          @endguest
        </div>
       
      </div>
    </nav>
  
  
  
  




