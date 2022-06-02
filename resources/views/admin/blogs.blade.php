@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Blogs</h4>
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
                <a href="{{url('admin/blogs/create')}}" class="btn btn-primary btn-sm my-2">Create New Blog</a>
                <div class="table-responsive">
                    <table id="blogs"
                        class="table table-striped table-sm table-bordered display no-wrap table-users" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date Create</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($blogs as $blog)
                             <tr>
                                 <td>{{$blog->created_at}}</td>
                                 <td>{{$blog->category}}</td>
                                 <td>{{$blog->title}}</td>
                                 <td>
                                    <form action="{{ route('blogs.destroy',$blog->id) }}" method="POST"> 
                                        @csrf
                                     <a href="{{url('/blogs/'.$blog->slug)}}" class="btn btn-success btn-sm">View</a>
                                     <a href="{{url('/admin/blogs/edit/'.$blog->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                     @method('DELETE')      
                                     <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                 </td>
                             </tr>
                           @endforeach
                           
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function(){
        var table=$('#blogs').DataTable()
    })
</script>
@endsection