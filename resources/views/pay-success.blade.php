@extends('layouts.app')
<title>Payment-Studymerit</title>
@section('content')
<section class="section_gap">
    <div class="container">
    <div class="jumbotron text-center">
   
  <h1 class="display-4 text-success">Success! <i class="fa fa-smile-o" aria-hidden="true"></i></h1>
  <p class="lead"><strong>Your payment has been received</strong> Proceed to download your documents.</p>
  
  
  <table id="cart" class="table table-hover ">
    <thead>
    <tr>
       <th >File</th>
       <th >Title</th>
       <th ></th>
    </tr>
    </thead>
   <tbody>
   @php $total = 0 @endphp
   @if(session('downloads'))
       @foreach(session('downloads') as $id => $details)
           @php $total += $details['price'] * $details['quantity'] @endphp
           <tr data-id="{{ $id }}" >
        
               <td>
                <img class="img-thumbnail" style="width:80px" src="{{$details['image']}}" alt="">
                
                      
               </td>
               <td data-th="Price"> <h4 class="nomargin">{{ Str::limit($details['name'],100) }}</h4></td>
              
               <td class="actions" data-th="">
                   <a href="{{url('/download/'.$details['filename'])}}" style="" class="btn btn-success text-white btn-block remove-from-cart"><i class="fa fa-download"></i> Download</a>
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