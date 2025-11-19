<title>Uploads - Study Rift</title>
@extends('layouts.client_layout')
@section('content')

<link rel="stylesheet" href="{{asset('theme/css/upload.css')}}">
<div class="page-wrapper">
    <div class="mt-5">
          <!-- Page title -->
          <div class="text-3xl my-4 font-bold">Upload New Document</div>
          @include('partials.response-status')
          <!--Form Section -->
          <section >
            <form method="post" enctype="multipart/form-data" class="bg-white p-6"  action="{{route('post-document')}}" >
              @csrf
              <div class="grid-container grid grid-cols-5 gap-4">
                <div class="item1 col-span-3">
                  <div class="relative z-0 w-full mb-6 group">
                    <label for="title" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Title of the document</label>
                    <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Title" required>
                  </div>
                </div>
                <div class="item2 col-span-2">
                  <div class="relative z-0 w-full mb-6 group">
                    <label for="code" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Unit Code Optional</label>
                    <input type="text" id="email" name="code" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Code" required>
                  </div>
                </div>
              </div>

              <div class="grid-container grid grid-cols-2 gap-4">
                <div class="item1 col-span-1">
                  <div class="relative z-0 w-full mb-6 group">
                    <label for="title" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Subject</label>
                    <select id="subject" name="subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option value="" >Select Subject</option>
                                @foreach($subjects as $subject)
                                 <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                    </select>                 
                  </div>
                </div>
                <div class="item2 col-span-1">
                  <div class="relative z-0 w-full mb-6 group">
                    <label for="category" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Category</label>
                    <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option value="" >Select Category</option>
                      @foreach($categories as $category)
                       <option value="{{$category->id}}">{{$category->name}}</option>
                     @endforeach
                    </select>                  </div>
                </div>
              </div>


          
           
            
              <div class="relative z-0 w-full mb-6 group">
                <label for="description" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Description</label>

                <textarea id="description" name="detail" rows="4" class="block p-2.5 w-full text-lg text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description"></textarea>
              </div>
              <div class="grid-container grid grid-cols-2 gap-4">
                <div class="item1 col-span-1">
                  <div class="relative z-0 w-full mb-6 group">
                    <label for="title" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Selling Price</label>
                    <input type="text" id="price" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Price" required>
                  </div>
                </div>
                <div class="item2 col-span-1">
                  <div class="relative z-0 w-full mb-6 group">
                    <label for="code" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Earning</label>
                    <input type="text" id="earning" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Earnings" required>
                  </div>
                </div>
              </div>
              <div class="relative z-0 w-full mb-6 group">
                <label for="file" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Choose File to Upload</label>
                <input type="file" required  name="file" id="file_upload" class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" data-traget-resolution="image_resolution"
                            
                accept="application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.openxmlformats-officedocument.presentationml.presentation" >
                <input data-required="image"   type="hidden"  name="thumb" id="thumb" >
              </div>
              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>

          </section>

          <section>
            <div id="pdf-main-container">
              <div id="pdf-loader">Loading document ...</div>
               <div id="pdf-contents">
                <div id="pdf-meta">
                  <div id="pdf-buttons">
                    <button class="btn btn-default" id="pdf-prev">Previous</button>
                    <button class="btn btn-info" id="pdf-next">Next</button>
                  </div>
                  <div class="form-group">
                 <span> <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                 </span>
                  </div>
                </div>
                <canvas id="pdf-canvas"  width="400"></canvas>
                <div id="page-loader">Loading page ...</div>
              </div>
            </div>
          </section>
         
    </div>


    
       

@endsection

@section('scripts')

<script>
$(document).ready(function (e) {   
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   });

   $("input[type=number]").bind('keyup input', function(){
    var price=this.value;
     var earning=price * 0.7;
     $('#earning').val(earning);
});
  

  
   $('#upload_image_form').submit(function(e) {

     e.preventDefault();
  
     var formData = new FormData(this);
  
     $.ajax({
        type:'POST',
        url: "{{ url('uploadFile')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
           this.reset();
           alert("File uploaded successfully");
        },
        error: function(data){
           console.log(data);
         }
       });
   });


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
    var pdf_original_width = page.getViewport(1).width;
    
    // as the canvas is of a fixed width we need to adjust the scale of the viewport where page is rendered
    var scale_required = _CANVAS.width / pdf_original_width;

    // get viewport to render the page at required scale
    var viewport = page.getViewport(scale_required);

    // set canvas height same as viewport height
    _CANVAS.height = viewport.height;

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
    $('#thumb').val($('#pdf-canvas').get(0).toDataURL("image/png"))
    $('#frame').attr('src', $('#pdf-canvas').get(0).toDataURL());
}

// click on "Show PDF" buuton

$('#file_upload').change(function(){
          
           let reader = new FileReader();
          
           reader.onload = (e) => { 
             
             $('#image_preview_container').attr('src', e.target.result); 
            
             var image=$('#pdf-canvas').get(0).toDataURL()
             $('#filename').html(this.files[0].name);
          
             showPDF(e.target.result);
             
           }
           reader.readAsDataURL(this.files[0]); 
         
           
         
          });

// click on the "Previous" page button
document.querySelector("#pdf-prev").addEventListener('click', function() {
    if(_CURRENT_PAGE != 1)
        showPage(--_CURRENT_PAGE);
});

// click on the "Next" page button
document.querySelector("#pdf-next").addEventListener('click', function() {
    if(_CURRENT_PAGE != _TOTAL_PAGES)
        showPage(++_CURRENT_PAGE);
});
});
</script>


 
@endsection