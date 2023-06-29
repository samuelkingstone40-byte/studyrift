@extends('layouts.admin')
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
	width: 100%;
	margin: 20px auto;
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
@if (\Session::has('success'))
<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
    role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Success - </strong> {!! \Session::get('success') !!}  
</div>

@endif
<div class="row">
   
    <div class="col-md-7">
    <h4 class="font-bold py-2">
                    {{$doc->title}}
                </h4>
        
               
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
                            <canvas id="pdf-canvas" width="580"></canvas>
                            <div id="page-loader">Loading page ...</div>
                        </div>
                      </div>
           
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h4 class="font-bold">
                   <b> Document Details</b>
                </h4>
                <ul class="list-group list-group-flush">
  <li class="list-group-item">Date Posted <span class="float-right"><b>{{$doc->created_at}}</b></span></li>
  <li class="list-group-item">Posted  By <span class="float-right"><b>{{$doc->uname}}</b></span></li>
  <li class="list-group-item">Subject <span class="float-right"><b>{{$doc->sname}}</b></span></li>
  <li class="list-group-item">Category <span class="float-right"><b>{{$doc->cname}}</b></span></li>
  <li class="list-group-item">Price <span class="float-right"> <b>${{number_format($doc->price,2)}}</b></span></li>
  <li class="list-group-item">Downloads <span class="float-right"> <b>{{number_format($downloads)}}</b></span></li>

</ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal"
                data-target="#deleteModal"><i class="fa fa-trash"></i> Delete file</button>

                <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h4 class="modal-title" id="myModalLabel">Delete file</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <form action="{{route('deleteFile',$doc->id)}}" method="post">
                            @csrf
                        <div class="modal-body text-center">
                          
                           <h4>Are you sure you want to delete this file?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light"
                                data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-success">Yes </button>
                        </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="py-2">
                    Description
                </h4>

                <p>
                    {{$doc->description}}
                </p>
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
var filepath="{{route('get-s3-bucket-file',$doc->filename)}}/"

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