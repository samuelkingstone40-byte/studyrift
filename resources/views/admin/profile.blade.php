@extends('layouts.admin')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <h4 class="py-1">Details</h4>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" id="" value="{{Auth::user()->name}}">
                </div>

                <div class="form-group">
                    <label for="">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" id="">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <h4 class="py-1">Password</h4>
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" name="" class="form-control" id="">
                </div>
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" name="" class="form-control" id="">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Update Password</button>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
