@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    @include('flashes')

                    <div class="panel-heading">
                        <h4>Мой профиль</h4>
                    </div>

                    <div class="panel-body">
                        <div class="panel-body">
                            <div class="default-tabs pull-right">
                                <a href="{{ route('applications.index', ['applicator_id' => $user->applicator->id]) }}">Мои
                                    заявки</a> |
                                <a href="{{ route('productranges.list', ['applicator_id' => $user->applicator->id]) }}">Номенклатура</a>
                                |
                                <a href="{{ route('contactquery.create', ['applicator_id' => $user->applicator->id]) }}">Мои
                                    обращения</a> |
                                <a href="{{ route('applicators.show', ['applicator_id' => $user->applicator->id]) }}">{{$user->lastName ." ". $user->firstName}}</a>
                            </div>

                            <div class="default-tabs">
                            </div>
                            <hr/>

                            <div class="article">
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
            </div>
        </div>
    </div>
@endsection
