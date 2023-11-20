@extends('layouts.default')
<meta name="description" content="{{$doc->description}}">
<meta name="keywords" content="study documents,lecture notes,summaries,practice exams,online tutoring,homework help,online homework help">
<title>{{$doc->title}}</title>
@section('content')

<div class="px-6 mx-auto py-10 mt-20 max-w-screen-xl">
    @if (\Session::has('success'))
        <div class="alert alert-success">
            {!! \Session::get('success') !!}   
        </div>
    @endif
    <span id="loader" class="circlespinner"></span>



    <nav class="flex my-1" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href={{url('/')}} class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
            </svg>
            Home
            </a>
        </li>
        <li>
            <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="{{url('search/')}}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Documents</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">view</span>
            </div>
        </li>
        </ol>
    </nav>

    <div class="">
        <div class="my-4 text-sm md:text-xl font-medium">{{$doc->title}}</div>
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-full md:col-span-4 bg-white p-4">
                <div class="content-center mx-auto justify-content-center p-4  border border-gray-300 rounded" id="pdf-main-container ">
                    <div id="pdf-loader">Loading document ...</div>
                    <div id="pdf-contents" class="p-2 bg-gray-50">
                    
                       <canvas class="w-full max-h-full"  id="pdf-canvas" ></canvas>
                      
                       <div id="page-loader">Loading page ...</div>
                    </div>
                    <div id="pdf-meta" class="mt-5">
                     <div id="pdf-buttons">
                       <div class="flex justify-between">
                         <!-- Previous Button -->
                         <a href="#" id="pdf-prev" class="flex items-center justify-center px-3 h-8 mr-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                           <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                           </svg>
                           Previous
                         </a>
                         <a href="#"  id="pdf-next" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                           Next
                           <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                           </svg>
                         </a>
                       </div>
                        
                     </div>
                     <div class="flex justify-start gap-2 mt-4" id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                    </div>
                </div>
                
                <div>
                    <h3 class=" py-2 font-semibold text-gray-600">Description</h3>
                    <p class="text-sm">{{$doc->description}}</p>
                </div>
                
            </div>
            <div class="col-span-full md:col-span-2">
                <div class="border border-gray-200 p-4 mt-4">
                    <div class="text-lg mb-2 p-1 flex justify-between border-b border-gray-200 ">Subject : <div>{{$doc->sname}}</div></div>
                    <div class="text-lg mb-2 p-1 flex justify-between border-b border-gray-200">Unit Code: <span></span></div>
                    <div class="text-lg mb-2 p-1 flex justify-between border-b border-gray-200">Unit: <span>{{$doc->cname}}</span></div>
                    <div class="text-lg mb-2 p-1 flex justify-between border-b border-gray-200">Price: <span>${{number_format($doc->price,2)}}</span></div>
                </div>  
                <div class="border border-gray-200 p-2 text-right">
                    <input type="hidden" name="" id="docId" value="{{$doc->id}}">
                    <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="addToCart" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                        <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                        </svg>
                       Add To Cart
                    </button>
                </div>

                <div class="border border-gray-200 p-4 mt-4">
                    <h3 class="title">Recommended for you</h3>
                    <div class="owl-carousel active_course">
                            @foreach($recommends as  $recommend)
                          <div class="single_course">
                            <div class="course_head">
                                image
                            </div>
                            <div class="course_content">
                              <span class="price">${{number_format($recommend->price)}}</span>
                              <span class="tag mb-4 d-inline-block">{{$recommend->sname}}/ {{$recommend->cname}}</span>
                              <h4 class="mb-3">
                                <a href="{{url('document-preview/'.$recommend->slug)}}">{{$recommend->title}}</a>
                              </h4>
                              
                              
                            </div>
                          </div>
                           @endforeach
                    </div>
                </div>
                
            
          
        </div>
    </div>
    </div>




    <div id="popup-modal" tabindex="-1" class=" bg-gray-600 bg-opacity-50 hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                <h3 class="text-green-400">Success</h3> <i class="fa fa-check fa-lg text-success"></i>
                <p class="py-4">Item added to your cart</p>
                <div class="my-4">
                    <a href="{{route('checkout')}}" class="text-white w-48 p-2 bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Checkout</a>

                </div>
                <div class="mt-8">
                    <a type="button" href="{{route('search')}}" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2" >Continue Shopping</a>
                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
                
                </div>
            </div>
        </div>
    </div>

    
  
    {{-- <div class="document-section">

     

     <input type="hidden"  id="file2" value="{{$doc->filename}}">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="content_wrapper">
              
                <div class="card document-description">
                    <div class="document-title">
                    {{$doc->title}}
                    </div>
                    <div class="description">
                        {{$doc->description}}
                    </div>
                </div>
                <div class="card document-content">
                    <div id="pdf-main-container">
                        <div  id="pdf-contents">
                            <div id="pdf-loader">
                                    <div class="spinner-border text-warning" role="status">
                                      <span class="sr-only">Loading...</span>
                                    </div>
                            </div>
                            <div id="pdf-meta">
                                <div id="pdf-buttons">
                                    <button id="pdf-prev">Previous</button>
                                    <button id="pdf-next">Next</button>
                                </div>
                                <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                            </div>
                            <canvas id="pdf-canvas"></canvas>
                            <div id="page-loader">

                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card document-right-contents">
                <div class="text-summary">Subject: <span>{{$doc->sname}}</span></div>
                <div class="text-summary">Unit Code: <span></span></div>
                <div class="text-summary">Unit: <span>{{$doc->cname}}</span></div>
                <div class="text-summary">Price: <span>${{number_format($doc->price,2)}}</span></div>

                <div class="add-to-cart">
                    <input type="hidden" name="" id="docId" value="{{$doc->id}}">
                   <button class="btn btn-add-to-cart" id="addToCart"><i class="fa fa-shopping-cart fa-lg"></i> Add To Cart</button>

                </div>

            </div>
            <div class="card seller-details">
              <div class="feedback-title">Seller</div>
              <div class="seller-content">
                <div class="seller-img">
                 <img class="img-fluid" width="80px" src="{{asset('theme/img/site/user.png')}}"/>
               </div>
               <div class="seller-name">
                {{$seller->name}}
               </div>
               <div class="seller-summary">
                 <div class="seller-summary-box">
                    <h4>Total Documents Uploads:{{$uploads}}</h4>
                    
                 </div>
                 <div class="seller-summary-box">
                 <h4>Total Downloads: {{$downloads}}</h4>
                    
                 </div>
               </div>

              </div>
           
            </div>
            <div class="card document-review">
                <div class="content">
                        <div class="feedeback">
                            <div class="feedback-title">Your Feedback</div>
                            <form action="{{route('post-review')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Rate </label>
                                     <div class="rating">
                                  
                                         <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                     </div>
                                 </div>
                            <input type="hidden" name="docId" value="{{$doc->id}}">
                            
                            <div class="form-group">
                                <label for="">Message</label>
                                <textarea name="review" required class="form-control"  rows="5"></textarea>

                            </div>
                           
                            <div class="mt-10 text-right">
                                <button type="submit" class="primary-btn2 text-right rounded-0 text-white">Submit</button>
                            </div>
                            </form>
                        </div>
                        
                    </div>

            </div>
                   
                   
                   

                  

                    <div class="comments-area mb-30">
                        @foreach ($reviews as $review)
                        <div class="comment-list">
                            <div class="single-comment single-reviews justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img class="img-thumbnails circle" width="65" src="{{asset('theme/img/default-user.png')}}" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="javascript:void(0)">{{$review->name}}</a>
                                            <div class="star">
                                                @for($i=0;$i<=$review->rating;$i++)
                                                <span class="ti-star checked"></span>
                                                @endfor
                                            </div>
                                        </h5>
                                        <p class="comment">
                                            {{$review->review}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach  
                      
                    </div>

                </div>

                <div class="col-lg-12">
            <hr class="mt-3">
          <h3 class="title">Recommended for you</h3>
            <div class="owl-carousel active_course">
                @foreach($recommends as  $recommend)
              <div class="single_course">
                <div class="course_head">
                    image
                </div>
                <div class="course_content">
                  <span class="price">${{number_format($recommend->price)}}</span>
                  <span class="tag mb-4 d-inline-block">{{$recommend->sname}}/ {{$recommend->cname}}</span>
                  <h4 class="mb-3">
                    <a href="{{url('document-preview/'.$recommend->slug)}}">{{$recommend->title}}</a>
                  </h4>
                  
                  
                </div>
              </div>
               @endforeach
            </div>
          </div>
        </div>
        </div>

<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center  mx-auto py-md-5 px-md-4 p-sm-3 p-4">
            <h3 class="text-success">Success</h3> <i class="fa fa-check fa-lg text-success"></i>
            <p class="r3 px-md-5 px-sm-1">Item added to your cart</p>
            <div class="text-center mb-3"> 
                <a href="{{route('checkout')}}" class="genric-btn primary circle w-50">Checkout</a>
             </div>

              <a class="genric-btn link-border" href="{{route('search')}}">Continue Shopping</a>
        </div>
    </div>
</div>
</section>

</div> --}}

@endsection

@section('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.6.347/build/pdf.min.js">  -->
<!-- </script> -->
<script>
    var filename=$('#file2').val();
    var filepath="{{route('get-s3-bucket-file',$doc->filename)}}"
    var _PDF_DOC,
        _CURRENT_PAGE,
        _TOTAL_PAGES,
        _PAGE_RENDERING_IN_PROGRESS = 0,
        _CANVAS = document.querySelector('#pdf-canvas');
   
    $('#loader').hide();
    $("#download-image").on('click', function() {
	    $(this).attr('href', $('#pdf-canvas').get(0).toDataURL());
	    // Specfify download option with name
	    $(this).attr('download', 'page.png');
    });

    $('#addToCart').click(function(e){
        var id=$('#docId').val();
        $('#loader').show();
        e.preventDefault();
        $.ajax({
                url: '{{ url("add-to-cart") }}/'+id,
                method: "get",
            
                success: function (response) {
                    $('#loader').hide();
                    $('#cartModal').modal('show');
                }
            });   
    })


    // initialize and load the PDF
    async function showPDF(pdf_url) {
        document.querySelector("#pdf-loader").style.display = 'block';

        // get handle of pdf document
        try {
            _PDF_DOC = await pdfjsLib.getDocument({ url: pdf_url });
        }
        catch(error) {
            alert(error.message);
        }

        // total pages in pdf
        _TOTAL_PAGES = _PDF_DOC.numPages;
        
        // Hide the pdf loader and show pdf container
        document.querySelector("#pdf-loader").style.display = 'none';
        document.querySelector("#pdf-contents").style.display = 'block';
        document.querySelector("#pdf-total-pages").innerHTML = _TOTAL_PAGES;

        // show the first page
        showPage(1);
    }

    // load and render specific page of the PDF
    async function showPage(page_no) {
        _PAGE_RENDERING_IN_PROGRESS = 1;
        _CURRENT_PAGE = page_no;

        // disable Previous & Next buttons while page is being loaded
        document.querySelector("#pdf-next").disabled = true;
        document.querySelector("#pdf-prev").disabled = true;

        // while page is being rendered hide the canvas and show a loading message
        document.querySelector("#pdf-canvas").style.display = 'none';
        document.querySelector("#page-loader").style.display = 'block';

        // update current page
        document.querySelector("#pdf-current-page").innerHTML = page_no;
    
    // get handle of page
    try {
        var page = await _PDF_DOC.getPage(page_no);
    }
    catch(error) {
        alert(error.message);
    }

    // original width of the pdf page at scale 1
    var pdf_original_width = page.getViewport(1).width;


    
    // as the canvas is of a fixed width we need to adjust the scale of the viewport where page is rendered
    var scale_required =1.6;

    // get viewport to render the page at required scale
    var viewport = page.getViewport(scale_required);

    console.log(viewport)

    // set canvas height same as viewport height
    _CANVAS.height = viewport.height
    _CANVAS.width=viewport.width
 

    // setting page loader height for smooth experience
    document.querySelector("#page-loader").style.height =  _CANVAS.height + 'px';
    document.querySelector("#page-loader").style.lineHeight = _CANVAS.height + 'px';

    // page is rendered on <canvas> element
    var render_context = {
        canvasContext: _CANVAS.getContext('2d'),
        viewport: viewport
    };
        
    // render the page contents in the canvas
    try {
        await page.render(render_context);
    }
    catch(error) {
        alert(error.message);
    }

    _PAGE_RENDERING_IN_PROGRESS = 0;

    // re-enable Previous & Next buttons
    document.querySelector("#pdf-next").disabled = false;
    document.querySelector("#pdf-prev").disabled = false;

    // show the canvas and hide the page loader
    document.querySelector("#pdf-canvas").style.display = 'block';
    document.querySelector("#page-loader").style.display = 'none';
}

// click on "Show PDF" buuton

showPDF(filepath);
// click on the "Previous" page button
document.querySelector("#pdf-prev").addEventListener('click', function() {
    if(_CURRENT_PAGE != 1)
        showPage(--_CURRENT_PAGE);
});

// click on the "Next" page button
document.querySelector("#pdf-next").addEventListener('click', function() {
    if(_TOTAL_PAGES =>10){
        if(_CURRENT_PAGE != Math.round(_TOTAL_PAGES*0.12))
        showPage(++_CURRENT_PAGE);

    }else{
        if(_CURRENT_PAGE != 1)
        document.querySelector("#pdf-next").disabled = true;
    document.querySelector("#pdf-prev").disabled = true;
      
    }
    
});



</script>
@endsection