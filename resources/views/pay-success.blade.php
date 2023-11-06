@extends('layouts.app')
<title>Payment-Studymerit</title>
@section('content')
<section class="section_gap">
    <div class="container">
        <div class="text-center bg-white p-4">
            <h1 class="display-4 text-success">Success! <i class="fa fa-smile-o" aria-hidden="true"></i></h1>
            <p class="lead my-4"><strong>Your payment has been received</strong> Proceed to download your documents.</p>
            
            <table id="cart" class="table table-hover border  ">
                <thead>
                    <tr>
                        <th >Subject</th>
                        <th >Category</th>
                        <th >Name</th>
                        <th >Download</th>
                    </tr>
                </thead>
                <tbody>
                    @php sizeof($orders) @endphp
                    @if(sizeof($orders)>0)
                        @foreach($orders as $id => $details)
                            {{-- @php $total += $details->price * $details->quantity @endphp --}}
                            <tr data-id="{{ $id }}" >
                                <td>
                                    {{$details->subject}}  
                                </td>
                                <td>
                                    {{$details->category}}  
                                </td>
                               
                                <td>  <h4 class="nomargin">{{ Str::limit($details->title,100) }}</h4></td>
                                
                                <td class="actions" data-th="">
                                    <a href="{{url('/download/'.$details->id)}}" style="" class="btn btn-success text-white  remove-from-cart"><i class="fa fa-download"></i> Download</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
<p>
  Having trouble? <a href="{{route('contact')}}">Contact us</a>
</p>
</div>
    </div>
</section>
@endsection