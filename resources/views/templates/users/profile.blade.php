@extends('layouts.master')

@section('content')

    @include('flashes')

    <h1 class="ai-title">Мой профиль</h1>
    <div class="pf-body">
        @isset($user)
            @include ('templates.profile.user', ['user' => $user, 'title' => 'Данные пользователя'])

            @isset($consigneers)
                @include ('templates.consigneers.list', ['consigneers' => $consigneers, 'title' => 'Грузополучатели'])
            @endisset

            @isset($cooperation)
                @include ('templates.cooperations.list', ['cooperation' => $cooperation, 'title' => 'Взаиморасчеты'])
            @endisset
        @endisset
    </div>
@endsection