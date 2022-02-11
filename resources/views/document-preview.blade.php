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
<section class="course_details_area section_gap">
        <div class="container">
        <nav aria-label="breadcrumb " class="py-1">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{url('search/')}}">List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
  </ol>
</nav>
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    
                    <div class="content_wrapper">
                        <h4 class="title">{{$doc->title}}</h4>
                        <div class="content">
                        <div id="pdf-main-container">
                        <input type="hidden"  id="file2" value="{{$doc->filename}}">
                        <div id="pdf-loader">Loading document ...</div>
                         <div id="pdf-contents">
                            <div id="pdf-meta">
                                <div id="pdf-buttons">
                                    <button id="pdf-prev">Previous</button>
                                    <button id="pdf-next">Next</button>
                                </div>
                                <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                            </div>
                            <canvas id="pdf-canvas" width="650"></canvas>
                            <div id="page-loader">Loading page ...</div>
                        </div>
                      </div>
                        </div>

                        <h4 class="title">Details</h4>
                        <div class="content">
                              {{$doc->description}}
                        </div>

                        
                    </div>
                </div>


                <div class="col-lg-4 right-contents py-5">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Subject</p>
                                <span class="or">{{$doc->sname}} </span>
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
                                <p>Date Posted </p>
                                <span class="or">15</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Price </p>
                                <span ><h4 class="font-bold text-success">$ {{number_format($doc->price,2)}}</h4></span>
                            </a>
                        </li>
                    </ul>
                   
                    <input type="hidden" name="" id="docId" value="{{$doc->id}}">
                    <a id="addToCart" href="" class="primary-btn text-uppercase enroll rounded-0 "><i class="fa fa-shopping-cart fa-lg"></i> Add To Cart</a>

                    <h4 class="title">Reviews</h4>
                    <div class="content">
                        <div class="review-top row pt-40">
                            <div class="col-lg-12">
                               
                                <div class="d-flex flex-row reviews justify-content-between">
                                    <span>Downloads</span>
                                    
                                    <span>10</span>
                                </div>
                                <div class="d-flex flex-row reviews justify-content-between">
                                    <span>Rating</span>
                                    <div class="star">
                                        <i class="ti-star checked"></i>
                                        <i class="ti-star checked"></i>
                                        <i class="ti-star checked"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                    </div>
                                  
                                </div>
                                
                            </div>
                        </div>
                        <div class="feedeback">
                            <h6>Your Feedback</h6>
                            <textarea name="feedback" class="form-control" cols="10" rows="10"></textarea>
                            <div class="mt-10 text-right">
                                <a href="#" class="primary-btn2 text-right rounded-0 text-white">Submit</a>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-lg-12">
<hr class="mt-3">
          <h3 class="title">Recommended for you</h3>
            <div class="owl-carousel active_course">
                @foreach($recommends as  $recommend)
              <div class="single_course">
                <div class="course_head">
                <img class="img-fluid" style="height:240px" src="{{$recommend->image}}" alt="" />
                </div>
                <div class="course_content">
                  <span class="price">${{number_format($recommend->price)}}</span>
                  <span class="tag mb-4 d-inline-block">{{$recommend->sname}}/ {{$recommend->cname}}</span>
                  <h4 class="mb-3">
                    <a href="course-details.html">{{$recommend->title}}</a>
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
                <a href="{{route('cart')}}" class="genric-btn primary circle w-50">Checkout</a>
             </div>

              <a class="genric-btn link-border" href="{{route('search')}}">Continue Shopping</a>
        </div>
    </div>
</div>

    </section>



@endsection

@section('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.6.347/build/pdf.min.js">  -->
<!-- </script> -->
<script>
$("#download-image").on('click', function() {
   
	$(this).attr('href', $('#pdf-canvas').get(0).toDataURL());
	
	// Specfify download option with name
	$(this).attr('download', 'page.png');
});

$('#addToCart').click(function(e){
    var id=$('#docId').val();
  
    e.preventDefault();
    $.ajax({
            url: '{{ url("add-to-cart") }}/'+id,
            method: "get",
           
            success: function (response) {
                $('#cartModal').modal('show');
            }
        });

    
})
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
    if(_CURRENT_PAGE != Math.round(_TOTAL_PAGES*0.12))
        showPage(++_CURRENT_PAGE);
});




</script>
@endsection