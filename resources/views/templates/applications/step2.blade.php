@extends('layouts.master')

@section('title', "Новая заявка")

@push('head')
    <style>
        .form__select-large input {
            color: #26645f;
            width: 100%;
        }

        .disabled {
            opacity: .5;
            pointer-events: none;
        }
    </style>
@endpush

@section('content')
    @include('flashes')

    <h1 class="ai-title">Новая заявка</h1>

    @include('templates.applications.information', ['application' => $application])

    <select-products :step="1"
                     :application="{{ $application->id }}"
                     :applicator="{{ $application->applicator_id }}"
    ></select-products>
    </div>

@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
