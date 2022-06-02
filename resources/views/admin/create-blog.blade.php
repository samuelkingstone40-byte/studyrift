@extends('layouts.admin')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<div class="row">
 <div class="col-md-12">
     <div class="card">
         <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div> 
            @endif
            @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
             <h4 class="card-title">New Blog</h4>
               <form action="{{url('/admin/blogs/store')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="row">
                  <div class="form-group col-sm-12">
                      <label for="">Category</label>
                      <input type="text" name="category" class="form-control">
                  </div>
                  <div class="form-group col-sm-12">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group col-sm-12">
                    <label for="">Blog Feature Image</label>
                    
                    <input type="file" name="filename" class="form-control-file">
                </div>
                <div class="form-group col-sm-12 my-2">
                    <textarea id="summernote" name="blog"></textarea>

                </div>
                <div class="form-group col-sm-12">
                    <button class="btn btn-success" type="submit">Post</button>
                </div>
              </div>
               </form>
         </div>

     </div>
 </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
       $('#summernote').summernote({
        placeholder: 'Type .....',
        tabsize: 2,
       
      });
    });
</script>
@endsection