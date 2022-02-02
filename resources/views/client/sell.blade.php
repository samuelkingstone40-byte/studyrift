@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('theme/css/upload.css')}}">

<section class="section_gap">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <form method="POST" enctype="multipart/form-data"  action="{{url('post-document')}}" >

         
             @csrf
             <div class="card">
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputEmail4">Document Title</label>
                    <input type="text" name="title" require class="form-control" id="inputEmail4" placeholder="Title">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Subject</label>
                    <select id="inputState" name="subject" class="form-control">
                      <option selected>Choose...</option>
                      @foreach($subjects as $subject)
                      <option value="{{$subject->id}}">{{$subject->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Category</label>
                    <select id="inputState" name="category" class="form-control ">
                      <option selected>Choose...</option>
                      @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                     @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" name="detail" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputCity">Price</label>
                      <input type="text" name="price" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputState">Earning Per Downloads</label>
                      <input type="text" class="form-control" id="inputCity">
                    </div>
                </div>

                <div class="form-row ">

        <div class="col-md-12">
        <div class="item-wrapper one">
    <div class="item">



            <div class="item-inner">
                <div class="item-content">
                  
                    <div class="image-upload">
                   
                        <label style="cursor: pointer;" for="file_upload"> 
                        <div class="h-100">
                                <div class="dplay-tbl">
                                 
                                    <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                        <h5><b>Choose Your Image to Upload</b></h5>
                                        <h6 class="mt-10 mb-70">Or Drop Your Image Here</h6>
                                    </div>
                                </div>
                                <label class="py-2" id="filename"></label>
                            </div>
                         
                            <!--upload-content--> 
                            <input data-required="image" type="file" name="file" id="file_upload" class="image-input" data-traget-resolution="image_resolution"
                            
                            accept="application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.openxmlformats-officedocument.presentationml.presentation"value="">
                          </label> 
                     
                      </div>
                </div>
                <!--item-content-->
            </div>
            <!--item-inner-->
      
    </div>
 
    <!--item-->
</div>
      


                <div class="form-row">
                     <button type="submit" class="primary-btn ">SAVE & NEXT</button>
                </div>
              </div>
            </div>          
         </form>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
$(document).ready(function (e) {
   
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   });
  
   $('#file_upload').change(function(){
           
    let reader = new FileReader();

    reader.onload = (e) => { 
      $('#filename').html(this.files[0].name);
      $('#image_preview_container').attr('src', e.target.result); 
    }

    reader.readAsDataURL(this.files[0]); 
  
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
});
</script>


 
@endsection