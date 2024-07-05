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

<div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
              <div class="col">
               
                <h2 class="page-title">
                Edit Document
                </h2>
              </div>
              <!-- Page title actions -->
             
            </div>
          </div>
    </div>

    <div class="page-body">
          <div class="container-xl">
            @if (\Session::has('success'))
              <div class="alert alert-success">
                  {!! \Session::get('success') !!}   
              </div>
            @endif
            <div class="row row-deck row-cards">
             <div class="col-sm-12">
               <form method="post" enctype="multipart/form-data" class="card" action="{{route('notes-update',$doc->id)}}">
               @csrf
               @method('PATCH')
               <input type="hidden" name="id" value="{{$doc->id}}">
                  <div class="card-header">
                    <h4 class="card-title">Document Information</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-xl-12">
                        <div class="row">
                          <div class="col-md-10 col-xl-12">
                            <div class="row">
                            <div class="mb-3 col-sm-8">
                              <label class="form-label">Title of the documet</label>
                              <input type="text" class="form-control" value="{{$doc->title}}" name="title" placeholder="Input placeholder">
                            </div>
                            <div class="mb-3 col-sm-4">
                              <label class="form-label">Unit Code(Optional)</label>
                              <input type="text" name="code" class="form-control" value="{{$doc->code}}" id="">
                            </div>
                            
                            <div class="mb-3 col-md-6">
                              <div class="form-label">Subject</div>
                              <select class="form-select"  name="subject">
                              <option value="{{$doc->category_id}}"  selected>{{$doc->sname}}</option>
                                @foreach($subjects as $subject)
                                 <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3 col-md-6">
                              <div class="form-label">Category</div>
                              <select name="category" class="form-select" >
                              <option value="{{$doc->category_id}}"  selected>{{$doc->sname}}</option>
                                 @foreach($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                              </select>
                            </div>
                           
                            
                            <div class="mb-3 col-md-6">
                              <label class="form-label">Price</label>
                              <input type="text" class="form-control" value="{{$doc->price}}" id="price" name="price" placeholder="Input placeholder">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label">Earning</label>
                              <input type="text" class="form-control" id="earning" placeholder="Input placeholder">
                            </div>
                            </div>
                           
                            <div class="mb-3">
                              <label class="form-label">Brief Description</label>
                              <textarea class="form-control" name="description" rows="6" placeholder="Content..">
                              {{$doc->description}}
                              </textarea>
                            </div>


                     
                           
                          </div>
                        </div>
                        <div class="form-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>
             </form>
               </div>

           

        <div class="col-sm-12">

    
            <div class="card mt-2">
              <div class="card-body">
              <input type="hidden"  id="file2" value="{{$doc->filename}}">
              <div id="pdf-main-container">
                  <div id="pdf-loader">Loading document ...</div>
                   <div id="pdf-contents">
                   <div id="pdf-meta">
                    <div id="pdf-buttons">
                    <button id="pdf-prev">Previous</button>
                    <button id="pdf-next">Next</button>
                  </div>
                  <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                </div>
                <canvas id="pdf-canvas" width="600"></canvas>
                <div id="page-loader">Loading page ...</div>
              </div>
              </div>
              </div>
            </div>

            <div class="card p-4 mt-2">
              <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{route('file-update')}}">
                       @csrf
                       <input type="hidden" name="id" value="{{$doc->id}}">
                     <div class="form-group">
                     <div class="mb-3">
                                    <div class="form-label">Choose New File </div>
                                    <input type="file"  name="file" id="file_upload" class="form-control" data-traget-resolution="image_resolution"
                                    
                                    accept="application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.openxmlformats-officedocument.presentationml.presentation" />
                                    <input data-required="image"   type="hidden"  name="thumb" id="thumb" >
                          </div>
        
                          <button type="submit" class="btn btn-primary">Upload</button>
        
                     </form>
                </div>
            </div>
              
        </div>
         
      
            </div>
          </div>

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
    var pdf_original_width = page.getViewport(1).width;
    
    // as the canvas is of a fixed width we need to adjust the scale of the viewport where page is rendered
    var scale_required = _CANVAS.width / pdf_original_width;

    // get viewport to render the page at required scale
    var viewport = page.getViewport(scale_required);

    // set canvas height same as viewport height
    _CANVAS.height = viewport.height;
    _CANVAS.width =860;
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