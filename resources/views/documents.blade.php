@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('theme/css/documents.css')}}">
<section class="section_gap ">
    <div class="cont m-4 py-2">
        <div class="row">
            <div class="col-sm-3">
             
                <div class="card">

                    <div class="card-header">
                        <div class="card-title">Filter</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Subject</label>
                            <select name="" id="" class="form-control">
                                <option value=""Select ...></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Subject</label>
                            <select name="" id="" class="form-control">
                                <option value=""Select ...></option>
                            </select>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="primary-btn">Search</button>
                    </div>
                </div>
             
            </div>
            <div class="col-sm-9">

           
    <div class="d-flex justify-content-center row">
        <div class="col-md-11">
        @foreach($notes as $index => $note)
            <div class="row p-2 bg-white mb-3 border rounded">
                <div class="col-md-3 mt-1">

              
                       <div  id="my_pdf_viewer" >
                       <div class="myClass" id="docs" >
                       <input  type="hidden"  id="file" value="{{$note->filename}}">
                            <canvas   id="pdf_renderer1{{$index}}" style="max-width:100%"></canvas>
                        </div>
                       </div>
                </div>
                <div class="col-md-6 mt-1">
                    <h4>{{$note->sname}} / {{$note->cname}}</h4>
                    <h5>{{$note->title}}</h5>
                   
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>
                    </div>
                  
                    <p class="text-justify text-truncate para mb-0">
                    {{$note->description}}
                    <br><br></p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h3 class="mr-1 text-success">${{number_format($note->price,2)}}</h3><span class="strike-text"></span>
                    </div>
                    <h6 class="text-success">Free shipping</h6>
                    <div class="d-flex flex-column mt-4"><a href="{{url('document-preview/'.$note->slug)}}" class="btn btn-primary btn-sm" >Details</a><button class="btn btn-outline-primary btn-sm mt-2" type="button">Add to wishlist</button></div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>

            
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
<script>

var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
$('#docs input').each(function ( value,index) {
    var filename=$(this).val()
    pdfjsLib.getDocument("{{asset('files')}}/"+ filename).then((pdf) => {
        myState.pdf = pdf;
        render();
    });
    function render() {
        myState.pdf.getPage(myState.currentPage).then((page) => {
     
            var canvas = document.getElementById("pdf_renderer1"+ value);
            var ctx = canvas.getContext('2d');
 
            var viewport = page.getViewport(myState.zoom);

            canvas.width = viewport.width;
            canvas.height = viewport.height;
     
            page.render({
                canvasContext: ctx,
                viewport: viewport
            });
        });
    }
});
        
    
    </script>
@endsection