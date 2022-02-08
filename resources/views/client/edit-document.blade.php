@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('theme/css/upload.css')}}">

<section class="section_gap">
    <div class="container">
      
       <div class="row justify-content-center">
      
        <div class="col-sm-10 mt-2 mb-2">
          <h4> Edit Document</h4>
          @if (\Session::has('success'))
          <div class="alert alert-success">
            {!! \Session::get('success') !!}   
           </div>
        @endif
          <div class="card">
           <div class="card-body">
            <form method="post" action="{{route('notes-update')}}">
              @csrf 
               <input type="hidden" name="id" value="{{$doc->id}}">
                <div class="form-group">
                  <label for="inputAddress">Document Title</label>
                  <input name="title" name="title" required value="{{$doc->title}}" type="text" class="form-control" id="inputAddress" placeholder="title">
                </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Subject</label>
                      <select name="subject" required id="inputState" class="form-control">
                        <option value="{{$doc->category_id}}"  selected>{{$doc->sname}}</option>
                        <option>...</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Category</label>
                      <select name="category" required id="inputState" class="form-control">
                        <option value="{{$doc->category_id}}" selected>{{$doc->cname}}</option>
                        <option>...</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Unit code (Optional)</label>
                      <input name="code" value="{{$doc->code}}" type="text" class="form-control" id="inputPassword4" placeholder="Unit Code">
                    </div>
                  
                  <div class="form-group col-md-4">
                      <label for="inputPassword4">Price($)</label>
                      <input name="price" value="{{$doc->price}}" type="text" class="form-control" id="inputPassword4" placeholder="Unit Code">
                    </div>
                
                  <div class="form-group col-md-4">
                      <label for="inputPassword4">Earning Per Download($)</label>
                      <input  type="text" class="form-control" id="inputPassword4">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputAddress">Description</label>
                    <textarea   class="form-control" name="description" id="" cols="30" rows="5">
                    {{$doc->description}}
                    </textarea>
                  </div>

                 
                  
                  <button type="submit" class="primary-btn pull-right">Update</button>
             </form>
           </div>
       </div>
       </div>
     
       <div class="col-sm-10 ">
          <div class="card">
           <div class="card-body">
             <form method="post" enctype="multipart/form-data" action="{{route('file-update')}}">
               @csrf
               <input type="hidden" name="id" value="{{$doc->id}}">
             <div class="form-group">
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
                                            <input data-required="image" required type="file" name="file" id="file_upload" class="image-input" data-traget-resolution="image_resolution"
                                            
                                            accept="application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.openxmlformats-officedocument.presentationml.presentation"value="">
                                          </label> 
                                    
                                      </div>
                                </div>
                                <!--item-content-->
                            </div>
                            <!--item-inner-->
                      
                    </div>
                  </div>
                  <button type="submit" class="primary-btn pull-right">Upload</button>

             </form>
           </div>
          </div>
       </div>


      
    </div>
</section>
@endsection
@section('scripts')
<script>
$(document).ready(function (e) {
   
  
   $('#file_upload').change(function(){
           
    let reader = new FileReader();

    reader.onload = (e) => { 
      $('#filename').html(this.files[0].name);
     
    }

    reader.readAsDataURL(this.files[0]); 
  
   });
  
 
});
</script>


 
@endsection