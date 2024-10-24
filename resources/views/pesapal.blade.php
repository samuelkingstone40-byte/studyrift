@extends('layouts.default')
@section('content')
<section class=" md:mt-20 py-20 bg-gray-50">
    <div class=" w-full">
        <div class="bg-white  flex justify-center mx-auto max-w-screen-lg">
            {!!$iframe!!}
        </div>    
    </div>
</section>

@endsection
