@extends('layouts.admin')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<div class="row">
 <div class="col-md-12">
     <div class="card">
         <div class="card-body">
            @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Success - </strong> {!! \Session::get('success') !!}  
            </div>

            @endif

            @if (\Session::has('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Failed - </strong> {!! \Session::get('error') !!}  
            </div>
            @endif
             <h4 class="card-title">Edit  Blog</h4>
               <form action="{{route('blogs.update',$blog->id)}}" method="post">
                @csrf
                @method('PUT')
              <div class="row">
                  <div class="form-group col-sm-12">
                      <label for="">Category</label>
                      <input type="text" name="category" value="{{$blog->category}}" class="form-control">
                  </div>
                  <div class="form-group col-sm-12">
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{$blog->title}}" class="form-control">
                </div>
                <div class="form-group col-sm-12">
                    <label for="">Blog Feature Image</label>
                    <div>
                        <img src="" class="img-thumbnail" alt="">
                    </div>
                  
                    <input type="filename" name="image" class="form-control-file">
                </div>
                <div class="form-group col-sm-12 my-2">
                    <textarea id="summernote" name="blog">{{$blog->blog}}</textarea>

                </div>
                <div class="form-group col-sm-12">
                    <button class="btn btn-success" type="submit">Update Blog</button>
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