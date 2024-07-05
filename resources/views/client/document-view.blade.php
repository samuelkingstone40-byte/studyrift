@extends('layouts.client_layout')
@section('content')

<style type="text/css">
    #show-pdf-button {
      width: 150px;
      display: block;
      margin: 20px auto;
    }

    #file-to-upload {
      display: none;
    }

    #pdf-main-container {
      margin: 10px auto;
    }

    #pdf-loader {
      display: none;
      text-align: center;
      color: #999999;
      font-size: 13px;
      line-height: 100px;
      height: 100px;
    }

    #pdf-contents {
      display: none;
    }

    #pdf-meta {
      overflow: hidden;
      margin: 0 0 20px 0;
    }

    #pdf-buttons {
      float: left;
    }

    #page-count-container {
      float: right;
    }

    #pdf-current-page {
      display: inline;
    }

    #pdf-total-pages {
      display: inline;
    }

    #pdf-canvas {
      border: 1px solid rgba(0,0,0,0.2);
      box-sizing: border-box;
    }

    #page-loader {
      height: 100px;
      line-height: 100px;
      text-align: center;
      display: none;
      color: #999999;
      font-size: 13px;
    }

</style>

<div class="px-4 bg-white">

  <div class="md:flex md:justify-between my-2">
    <div class=" text-lg md:text-2xl  font-semibold ">
      {{$doc->title}}
    </div>
    @include('partials.response-status')
  
      
      <div class="md:flex md:justify-start">
        @if($purchased)
      <a href="{{url('download/'.$doc->id)}}" class="mb-2 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full text-center inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        <svg class="w-6 h-6 pr-2 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
        </svg>
        Download
      </a>
      @endif
        <a href="{{url('edit-document/'.$doc->slug)}}" class="mb-2 mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 w-full py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
          Edit
        </a>

        <button data-modal-target="default-modal" data-modal-toggle="default-modal" class=" text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full py-2 text-sm px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
         Delete
        </button>
      </div>
    </div>
  

  <div class="flex">
    <div class="text-xl font-semibold mb-2">Subject : {{$doc->sname}}</div>
    <div class="text-xl font-semibold mb-2">Category : {{$doc->cname}}</div>
    <div class="text-xl font-semibold mb-2">Price :${{$doc->price}}</div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3">
    <div class="md:col-span-2">
      <div class="bg-white card mb-4">
        <div class="card-body">
          <h3 class="text-xl font-semibold mb-2">Description</h3>
          <p>
            {{$doc->description}}
          </p>
        </div>
      </div>
      <div class="mb-4 card py-2">
        <input type="hidden"  id="file2" value="{{$doc->filename}}">
        
          <div class="" id="pdf-main-container justify-content-center">
            <div id="pdf-loader">Loading document ...</div>
             <div id="pdf-contents" class="px-4 mb-2">
           
                <canvas class=" w-full" id="pdf-canvas" ></canvas>
                <div id="page-loader">Loading page ...</div>
            </div>
            <div id="pdf-meta" class="px-4">
              <div id="pdf-buttons" class="flex justify-between items-center">
                <div class="flex">
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
                <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>

              </div>
          </div>
    </div>
       
     
      </div>




    </div>

    <div>
      <div class="mx-4 card">
        <div class="card-body">
          <h3 class="text-xl font-semibold mb-2">Document Reviews</h3>
          @foreach ($reviews as $review)
           <div>
             <div class="row">
               <div class="col-auto">
                 <span class="avatar">{{$review->name}}</span>
               </div>
               <div class="col">
                 <div class="text-truncate">
                 {{$review->review}}
                 </div>
                 <div class="text-muted">
                 <div class="star">
                     @for($i=0;$i<=$review->rating;$i++)
                     <span class="ti-star checked"></span>
                     @endfor
                </div>
                 </div>
               </div>
               <div class="col-auto align-self-center">
                 <div class="badge bg-primary"></div>
               </div>
             </div>
           </div>
           @endforeach
        </div>
      </div>
    </div>
  </div>








  <!-- Modal toggle -->


<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <form action="{{route('fileDelete',$doc->id)}}" method="post">
            @csrf
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                   Delete File
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                  Are you sure you want to delete this file?
                </p>

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="default-modal" type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Delete</button>
            </div>
          </form>
        </div>
    </div>
</div>

</div>







</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>

<script>

var filename=$('#file2').val();
var filepath="{{route('get-s3-bucket-file',$doc->filename)}}"

var _PDF_DOC,
    _CURRENT_PAGE,
    _TOTAL_PAGES,
    _PAGE_RENDERING_IN_PROGRESS = 0,
    
    _CANVAS = document.querySelector('#pdf-canvas');

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
    var pdf_original_width = page.getViewport(0.1).width;
    
    // as the canvas is of a fixed width we need to adjust the scale of the viewport where page is rendered
    var scale_required = _CANVAS.width / pdf_original_width;

    // get viewport to render the page at required scale
    var viewport = page.getViewport(scale_required);

    // set canvas height same as viewport height
    _CANVAS.height = (viewport.height);
    _CANVAS.width =viewport.width;
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
    if(_CURRENT_PAGE != Math.round(_TOTAL_PAGES))
        showPage(++_CURRENT_PAGE);
});




</script>
@endsection