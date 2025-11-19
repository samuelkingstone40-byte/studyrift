@extends('layouts.app')
<title>Upload - Study Rift</title>
@section('content')
<link rel="stylesheet" href="{{asset('theme/css/documents.css')}}">
<link rel="stylesheet" href="{{asset('theme/css/upload.css')}}">

@php
// Hardcoded categories
$categories = [
    ['id' => 1, 'name' => 'Math'],
    ['id' => 2, 'name' => 'Nursing'],
    ['id' => 3, 'name' => 'Science'],
    ['id' => 4, 'name' => 'Biology'],
    ['id' => 5, 'name' => 'Chemistry'],
    ['id' => 6, 'name' => 'Physics'],
    ['id' => 7, 'name' => 'History'],
    ['id' => 8, 'name' => 'English'],
    ['id' => 9, 'name' => 'Computer Science'],
    ['id' => 10, 'name' => 'Business'],
    ['id' => 11, 'name' => 'Economics'],
    ['id' => 12, 'name' => 'Psychology'],
];

// Hardcoded subjects
$subjects = [
    ['id' => 1, 'name' => 'Exam'],
    ['id' => 2, 'name' => 'Quiz'],
    ['id' => 3, 'name' => 'Assignment'],
    ['id' => 4, 'name' => 'Notes'],
    ['id' => 5, 'name' => 'Practice Test'],
    ['id' => 6, 'name' => 'Study Guide'],
    ['id' => 7, 'name' => 'Homework'],
    ['id' => 8, 'name' => 'Lab Report'],
    ['id' => 9, 'name' => 'Midterm'],
    ['id' => 10, 'name' => 'Final'],
];
@endphp

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

                    <!-- CATEGORY DROPDOWN -->
                    <div class="form-group mb-3">
                        <label for="category_id"><b>Category</b> <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- SUBJECT DROPDOWN -->
                    <div class="form-group mb-3">
                        <label for="subject_id"><b>Subject</b> <span class="text-danger">*</span></label>
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            <option value="">-- Select Subject --</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

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
