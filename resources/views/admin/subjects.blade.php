@extends('layouts.admin')
@section('content')
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Manage Subjects</h4>
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
                                <div class="table-responsive">
                                <div class="btn-list py-2">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#subject-modal"><i class="fas fa-plus"></i> Add New</button>
                                </div>
                                    <table id="multi_col_order"
                                        class="table table-striped table-sm table-bordered display no-wrap table-users" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Manage</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subjects as $index =>$subject )
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{$subject->name}}</td>
                                                <td>
                                                    <a data-toggle="modal"
                                                      data-target="#subject-modal" href="http://" class="btn btn-primary btn-sm">Manage</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                           
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Manage</th>
                                               
                                            </tr>
                                        </tfoot>
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
                                                <h5 class="modal-title" id="scrollableModalTitle">Add New Subject</h5>
                                                
                                            </div>
                                            <div class="modal-body">
                                           

                                                <form action="{{route('post-subject')}}" method="post" class="pl-3 pr-3">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="emailaddress1">Subject</label>
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

    $(".infoS").click(function (e) {
                $('#pic').attr('src',$(this).attr("data-pic"));
                $currID = $(this).attr("data-id");
                $.post("detail.blade.php", {id: $currID}, function (data) {
                    $('#user-data').html(data);
                    }
                );
            });
    
  });
</script>
@endsection