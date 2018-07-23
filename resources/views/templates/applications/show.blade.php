@extends('layouts.master')

@section('title', "Детальная страница заявки")

@section('content')

    @include('flashes')

    @include('templates.applications.information', ['application' => $application])

        <div class="a-goods">

            @include('templates.applications.products', ['application' => $application, 'product_applications' => $product_applications])

            @isset($application->contactquery->querytext)
            <div class="a-comment comment">
                <span class="comment__title">Комментарий:</span>
                <div class="comment__text">
                    {{ $application->contactquery->querytext }}
                </div>
            </div>
            @endisset

        </div>

        @isset($lunits)
            @include('templates.applications.shipments', ['lunits' => $lunits, 'active' => $active])
        @endisset

    </div>
@endsection


