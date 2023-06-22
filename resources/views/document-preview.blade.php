@extends('layouts.default')

<meta name="description" content="{{$doc->description}}">
<meta name="keywords" content="study documents,lecture notes,summaries,practice exams,online tutoring,homework help,online homework help">
<title>{{$doc->title}}</title>
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

.rating {
    display: inline-flex;
    
    flex-direction: row-reverse
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 2vw;
    color: #FFD600;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}

</style>
<span  id="loader" class="circlespinner"></span>
<section class="course_details_area section_gap">
    
        <div class="container">
        <nav aria-label="breadcrumb " class="py-1">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{url('search/')}}">Documents</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$doc->title}}</li>
  </ol>
</nav>
@if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}   
    </div>
@endif
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    
                    <div class="content_wrapper">
                        <h4 class="title">{{$doc->title}}</h4>
                        <div class="content">
                        <div id="pdf-main-container">
                        <input type="hidden"  id="file2" value="{{$doc->filename}}">
                        <div class="text-center">
                        </div>
                        <div id="pdf-loader">
                            <div class="spinner-border text-warning" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>
                         <div  id="pdf-contents">
                            <div id="pdf-meta">
                                <div id="pdf-buttons">
                                    <button id="pdf-prev">Previous</button>
                                    <button id="pdf-next">Next</button>
                                </div>
                                <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                            </div>
                            <div class="col-lg-8"><canvas id="pdf-canvas" width="650"></canvas></div>
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
                                <span class="or">{{$doc->created_at}}</span>
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
                       
                        <div class="feedeback">
                            <h6>Your Feedback</h6>
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
                                <textarea name="review" required class="form-control" cols="10" rows="10"></textarea>

                            </div>
                           
                            <div class="mt-10 text-right">
                                <button type="submit" class="primary-btn2 text-right rounded-0 text-white">Submit</button>
                            </div>
                            </form>
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
                <a href="{{route('checkout')}}" class="genric-btn primary circle w-50">Checkout</a>
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