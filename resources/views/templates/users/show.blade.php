@extends('layouts._app')

@section('content')
    <div class="container">

        @include ('flashes')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div>
                        <div class="panel-heading">
                            <h3 class="panel-title">

                                <a href="{{ route('applications.create', ['applicator_id' => $user->applicator->id]) }}">Создать
                                    заявку</a> |
                                <a href="{{ route('contactquery.create', ['applicator_id' => $user->applicator->id]) }}">Создать
                                    обращение</a> |
                                <a href="{{ route('productranges.list', ['applicator_id' => $user->applicator->id]) }}">Номенклатура</a> |

                            </h3></div>
                    </div>
                    <div class="panel-heading"><h3>Мой профиль</h3></div>
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