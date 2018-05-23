@extends('layouts._app')

@section('content')
<div class="container">

    @include ('flashes')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <a href="{{ route('applications.create', ['applicator_id' => $user->applicator->id])}}">Создать заявку</a>
                <div class="panel-heading">Мой профиль</div>
                <td>@isset($user)
                        @include ('templates.profile.user', ['user' => $user, 'title' => 'Данные пользователя'])
                    @endisset
                </td>
                <td>
                    @isset($consigneers)
                        @include ('templates.consigneers.list', ['consigneers' => $consigneers, 'title' => 'Грузополучатели'])
                    @endisset
                </td>
                <td>
                    @isset($cooperation)
                        @include ('templates.cooperations.list', ['cooperation' => $cooperation, 'title' => 'Взаиморасчеты'])
                    @endisset
                </td>
            </div>
        </div>
    </div>
</div>

@endsection