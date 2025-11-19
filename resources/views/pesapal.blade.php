@extends('layouts.default')
@section('title', 'Secure Payment - StudyRift')
@section('content')
<style>
/* Pesapal iframe styling to prevent scrolling */
section iframe {
    width: 100% !important;
    min-height: 750px !important;
    height: auto !important;
    border: none !important;
    overflow: visible !important;
}

.payment-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 1rem;
}

@media (min-width: 768px) {
    section iframe {
        min-height: 700px !important;
    }
    .payment-container {
        padding: 2rem;
    }
}

@media (max-width: 767px) {
    section iframe {
        min-height: 850px !important;
    }
}
</style>

<section class="py-8 md:py-12 bg-gray-50">
    <div class="w-full text-center mb-4">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Secure Payment - StudyRift</h1>
        <p class="text-gray-600 mt-2 text-sm md:text-base">Complete your payment safely and securely below.</p>
    </div>
    <div class="payment-container bg-white rounded-lg shadow-sm">
        {!! $iframe !!}
    </div>
</section>
@endsection

