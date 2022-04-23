@extends('layouts.app')
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
<section class="section_gap">
    <div class="container">
  
<div class="row d-flex justify-content-center">
@if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}   
    </div>
@endif
    <div class="col-md-11">
        <div class="card">
            <div class="card-body">
               <h4 class="font-bold py-2">
                    {{$doc->title}}
                    @if($purchased)
                    <span class="float-right">
                        <a href="{{url('download/'.$doc->filename)}}" class="genric-btn primary radius"> <i class="fa fa-download"></i> Download</a>
                    
                    </span>
                    @else
                    <span class="float-right">
                        <a href="{{url('edit-document/'.$doc->slug)}}" class="btn btn-primary"> <i class="fa fa-pencil"></i> Edit</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#deleteModal"><i class="fa fa-trash"></i> Delete file</button>
        
                    </span>
                    @endif
                </h4>
                <div class="col-lg-6 right-contents">
<ul>
<li>
<a class="justify-content-between d-flex" href="#">
<p>Subject</p>
<span class="or">{{$doc->sname}}</span>
</a>
</li>
<li>
<a class="justify-content-between d-flex" href="#">
<p>Category </p>
<span class="or">{{$doc->cname}}</span>
</a>
</li>
<li>
<a class="justify-content-between d-flex" href="#">
<p>Price </p>
<span class="or">${{number_format($doc->price,2)}}</span>
</a>
</li>

</ul>
</div>
               
        

               <input type="hidden"  id="file2" value="{{$doc->filename}}">
                <div id="pdf-main-container justify-content-center">
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
           
    </div>
  
    <div class="col-md-11 py-2">
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
<div class="col-md-11">

    <div class="comments-area mb-20">
        <h4>Reviews</h4>
        @foreach ($reviews as $review)
        <div class="comment-list">
            <div class="single-comment single-reviews justify-content-between d-flex">
                <div class="user justify-content-between d-flex">
                    <div class="thumb">
                        <img class="img-thumbnail" width="85" src="{{asset('theme/img/default-user.png')}}" alt="">
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
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger text-white">
            <h4 class="modal-title" id="myModalLabel">Delete file</h4>
            <button type="button" class="close" data-dismiss="modal"
                aria-hidden="true">×</button>
        </div>
        <form action="{{route('fileDelete',$doc->id)}}" method="post">
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

      
</div>
</section>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>

<script>

var filename=$('#file2').val();
var filepath="{{asset('files')}}/"+ filename

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