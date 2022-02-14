@extends('layouts.admin')
@section('content')
<div class="row">
                    <div class="col-12">
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
                                <h4 class="card-title">Manage Categories</h4>
                                <div class="table-responsive">
                                <div class="btn-list py-2">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#category-modal"><i class="fas fa-plus"></i> Add New</button>
                                </div>
                                    <table id="multi_col_order"
                                        class="table table-striped table-sm table-bordered display no-wrap table-users" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                
                                                <th></th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $index =>$category )
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>
                                                <form action="{{ route('categories.destroy',$category->id) }}" method="POST">   
                                                    <a class="btn btn-primary btn-sm" href="{{ route('categories.edit',$category->id) }}">Edit</a>   
                                                    @csrf
                                                    @method('DELETE')      
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                           
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>No</th>
                                                <th>Name</th>
                                               
                                                <th></th>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                              
                            </div>
                      </div>
                </div>
</div>

<div id="category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="scrollableModalTitle">Add New Category</h5>
                                                
                                            </div>
                                            <div class="modal-body">
                                           

                                                <form action="{{route('categories.store')}}" method="post" class="pl-3 pr-3">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="emailaddress1">Category</label>
                                                        <input class="form-control" name="name" type="text" id="emailaddress1"
                                                            required="" placeholder="Enter name">
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

@section('scripts')
<script type="text/javascript">
  $(function () {
    
    var table = $('.table-users').DataTable({
        
       
    });
    
  });
</script>
@endsection