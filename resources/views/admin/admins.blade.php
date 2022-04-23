@extends('layouts.admin')
@section('content')
<div class="container">
    @if (\Session::has('success'))
    <div class="alert alert-success">
      {!! \Session::get('success') !!}   
     </div>
  @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage System User Accounts</h4>
                   
                    <div class="table-responsive">
                        <button type="button" class=" mb-2 btn btn-info" data-toggle="modal"
                        data-target="#subject-modal"><i class="fas fa-plus"></i> Add New</button>
                        <table id="multi_col_order"
                            class="table table-striped table-sm table-bordered display no-wrap table-users" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($admins as $index=> $admin)
                                   <tr>
                                       <td>{{$index+1}}</td>
                                       <td>{{$admin->name}}</td>
                                       <td>{{$admin->email}}</td>
                                       <td>{{$admin->is_super}}</td>
                                       <td>
                                           <a href="javascript:void(0)" class="btn btn-primary btn-sm">Manage</a>
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
</div>


<div id="subject-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalTitle">Add New User</h5>
                
            </div>
            <div class="modal-body">
           

                <form action="{{route('postUser')}}" method="post" class="pl-3 pr-3">
                    @csrf

                    <div class="form-group">
                        <label for="">Name</label>
                        <input id="name" type="text" placeholder="Your Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
  
                          @error('name')
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email Address</label>
                        <input id="email" type="email" placeholder="Your Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
  
                              @error('email')
                                  <span class="invalid-feedback d-block" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                        <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
  
                              @error('password')
                                  <span class="invalid-feedback d-block" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                           <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                      


                  

                    <div class="form-group text-right">
                        <button class="btn btn-primary" type="submit">Save
                            </button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection