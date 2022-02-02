@extends('layouts.app')
@section('content')
<section class="section_gap">
    <div class="container py-2">
        <div class="row">
            <div class="col-sm-8">
               <div class="card">
                   <div class="card-body">
                       <div class="text-left mb-2">
                           <h3>{{$doc->title}}</h3>
                       </div>
                       <p> {{$doc->description}}</p>
                       <input type="hidden"  id="file2" value="{{$doc->filename}}">
                       <div id="my_pdf_viewer" >
                       <div id="canvas_container" >
                            <canvas id="pdf_renderer" style="max-width:100%"></canvas>
                        </div>
                       </div>
                   </div>
               </div>
               <div class="card mt-4">
                   <div class="card-body">
                       Reviews
                   </div>
               </div>


               <div class="card mt-2">
                   <div class="card-body">
                      <h4 class="font-bold"> Recommended For You</h4>
                   </div>
               </div>

            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="font-bold">{{$doc->cname}}</h4>
                        <h3 class="font-bold text-success">$ {{number_format($doc->price,2)}}</h3>
                        <div class="mt-3">
                            <a href="{{ route('add.to.cart', $doc->id) }}" class="btn btn-primary "><i class="fa fa-shopping-cart fa-lg"></i> Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('scripts')
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
</script>
<script>

$(document).ready(function(){
    var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 3
        }
     var filename2=document.getElementById("file2").value;
  
    
        pdfjsLib.getDocument("{{asset('files')}}/"+filename2).then((pdf) => {
     
            myState.pdf = pdf;
            render();

        });

        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {
         
                var canvas = document.getElementById("pdf_renderer");
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

        $(".update-cart").change(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

})
  
   
    </script>
@endsection