@extends('layouts.master')

@section('title', "Новая заявка")

@section('content')

    <select-product :step="0"></select-product>

@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
