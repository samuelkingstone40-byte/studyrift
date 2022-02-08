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
        <div class="col-md-12">
        @foreach($notes as $index => $note)
            <div class="row p-2 bg-white mb-3 border rounded">
                <div class="col-md-3 mt-1">
                   
                <img src="{{$note->image }}" width="230">
              
                      
                </div>
                <div class="col-md-6 py-4">
                    <h4>{{$note->sname}} / {{$note->cname}}</h4>
                    <h5 class="font-bold py-2">{{$note->title}}</h5>
                   
                   
                    <p class="text-justify text-truncate para ">
                    {{$note->description}}
                   </p>
                    <h5 class="numPages" id="{{$note->slug}}"></h5>
                    <p>Date Posted - <span class="font-bold">{{$note->created_at}}</span></p>
                </div>
                <div class="col-md-3 border-left mt-1">
                    <div class="text-center py-4">
                       <h4>{{$note->sname}} / {{$note->cname}}</h4>
                       
                        <h2 class="mr-1 text-success">${{number_format($note->price,2)}}</h2><span class="strike-text"></span>
                    
                        <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                    </div>
                  
                    <div class="d-flex flex-column mt-2"><a href="{{url('document-preview/'.$note->slug)}}" class="primary-btn btn-sm font-weight" >Details</a></div>
                </div>
            </div>
            @endforeach
            
        </div>
        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                
                                {{$notes->links()}}
                                
                            </ul>
                        </nav>
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
            zoom:.6
        }
       
$('#docs input').each(function ( value,index) {
    var filename=$(this).val()
        pdfjsLib.getDocument("{{asset('files')}}/"+ filename).then((pdf) => {
        $(".numPages").text("Number of Pages : "+ pdf.numPages);
        myState.pdf = pdf;
        render();
    });
    function render() {
        myState.pdf.getPage(myState.currentPage).then((page) => {
     
            var canvas = document.getElementById("pdf_renderer1"+ value);
            var ctx = canvas.getContext('2d');
 
            var viewport = page.getViewport(myState.zoom);

            canvas.width = viewport.width;
            canvas.height = 330;
     
            page.render({
                canvasContext: ctx,
                viewport: viewport
            });
        });
    }
});
        
    
    </script>
@endsection