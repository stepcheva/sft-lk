@extends('layouts.master')

@section('title', "Новая заявка")

@section('content')

    @include('flashes')
    <h1 class="ai-title">Новая заявка</h1>
    <select-products :step="0" :applicator="{{ $applicator->id }}" ></select-products>

@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush