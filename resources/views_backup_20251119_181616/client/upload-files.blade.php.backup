@extends('layouts.app')
<title>Upload-Studymerit</title>
@section('content')
<link rel="stylesheet" href="{{asset('theme/css/documents.css')}}">
<link rel="stylesheet" href="{{asset('theme/css/upload.css')}}">
<section class="section_gap">
  <div class="container">
    <div class="row">
    <div class="col-md-12">
                    <div class="tab-pane active documents documents-panel">
                      @foreach($files as $file)
                      
                        <div class="document success">
                            <div class="document-body">
                              @if($file->file_ext=="xls")
                                  <i class="fa fa-file-excel-o text-success"></i>
                              @elseif($file->file_ext=="pdf")
                              <i class="fa fa-file-pdf-o text-danger"></i>
                              @elseif($file->file_ext=="docx")
                              <i class="fa fa-file-word-o text-info"></i>
                              @endif
                            </div>
                            <div class="document-footer">
                                <span class="document-name"> {{$file->filename}} </span>
                                <span class="document-description"> 1.2 MB </span>
                            </div>
                        </div>
                        @endforeach
                        
                        
                   
                </div>
            </div>
        </div>
</div>
<div class="row justify-content-center">

        <div class="col-md-10">
        <div class="item-wrapper one">
    <div class="item">



          <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="javascript:void(0)" >
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
                            <input data-required="image" type="file" name="file" id="file_upload" class="image-input" data-traget-resolution="image_resolution" value="">
                            <button type="submit"  value="Upload" id="but_upload"  class="btn btn-primary">Upload</button>
                          </label> 
                     
                      </div>
                </div>
                <!--item-content-->
            </div>
            <!--item-inner-->
        </form>
    </div>
 
    <!--item-->
</div>
      


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