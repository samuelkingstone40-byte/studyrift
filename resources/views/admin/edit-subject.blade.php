@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
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
        <div class="card">
            <div class="card-body">

                <form action="{{route('subjects.update',$subject->id)}}" method="POST">
                @csrf
                @method('PUT')
                <h4 class="py-2"><b>Manage subject</b></h4>
                <input type="hidden" name="id">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$subject->name}}" id="">
                </div>

                <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
        

    </div>
</div>
@endsection
    
