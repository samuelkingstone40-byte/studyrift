@extends('layouts.app')
<title>Payment-Studymerit</title>
@section('content')
<section class="">
    <div class="">
        <div class="bg-white p-4 my-3 shadow rounded">
            <h1 class="text-success text-center">
                Success! <i class="fa fa-smile-o" aria-hidden="true"></i>
            </h1>
            <p class="lead my-4 text-center">
                <strong>Your payment has been received.</strong> Proceed to download your documents.
            </p>
        
            <div class="table-responsive">
                <table id="cart" class="table table-hover table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($orders) > 0)
                            @foreach($orders as $id => $details)
                                <tr data-id="{{ $id }}">
                                    <td>{{ $details->subject }}</td>
                                    <td>{{ $details->category }}</td>
                                    <td>
                                        <h4 class="nomargin text-wrap">{{ Str::limit($details->title, 100) }}</h4>
                                    </td>
                                    <td class="actions" data-th="">
                                        <a href="{{ url('/download/' . $details->id) }}" 
                                           class="btn btn-success text-white btn-sm">
                                           <i class="fa fa-download"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">No orders available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        
            <p class="text-center mt-4">
                Having trouble? <a href="{{ route('contact') }}">Contact us</a>
            </p>
        </div>
    </div>
</section>
@endsection