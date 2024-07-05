@extends('layouts.admin')
@section('content')
    <div>
        <div>
            <nav  aria-label="breadcrumb">
                <ol class="breadcrumb px-0">
                <li class="breadcrumb-item"><a href={{ url('admin/dashboard')}}>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
            <h3 class="page-header">Manage Users</h3>
            @include('partials.response-status')
        </div>
        <div>
            <div class="card">
                <div class="card-body">
                    <h3>User Personal Details</h3>
                    <div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input class="form-control" value={{$user->name}} />
                        </div>
        
                        <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control" value={{$user->email}} />
                        </div>

                        <div class="form-group">
                            <label for="">Paypal Email</label>
                            <input class="form-control" value={{$user->paypalEmail}} />
                        </div>

                        <div class="form-group">
                            <label for="">Status</label>
                            @if ($user->status == 1)
                                <div style="color: green">Active</div>
                            @else
                                <div style="color: #FF4500">Deactivated</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    @if ($user->status == 1)
                    <Button class="btn" style="color: #fff;background:#FF4500" data-toggle="modal" data-target="#deactivateModal">Deactivate Account   <i class="ti-na"></i></Button>
                    @else
                    <Button class="btn" style="color: #fff;background:green" data-toggle="modal" data-target="#activateModal">Activate Account   <i class="ti-check"></i></Button>
                    @endif
                </div>
            </div>
            <div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" >
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                          <h5 class="modal-title" id="exampleModalLabel">Deactivate User Account</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action={{route('deactivate-user-account',$user->id)}}>
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                            <h3 class="mb-4"> Are you sure you want to deactivate account?</h3>
                        
                                <div class="form-group">
                                    <label for="">Reason for deactivating</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Deactivate</button>
                            </div>
                        </form>
                      </div>
                </div>
            </div>

            <div class="modal fade" id="activateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" >
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                          <h5 class="modal-title" id="exampleModalLabel">Activate User Account</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action={{route('activate-user-account',$user->id)}}>
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                             <h3 class="mb-4"> Are you sure you want to Activate account?</h3>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Activate</button>
                            </div>
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </div>



@endsection