@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    @include('flashes')

                    <div class="panel-heading">
                        <h4>Мои заявки</h4>
                    </div>

                    <div class="panel-body">
                        <div class="panel-body">
                            <div class="default-tabs pull-right">
                                <a href="{{ route('applications.index', ['applicator_id' => $applicator->id]) }}">Мои
                                    заявки</a> |
                                <a href="{{ route('productranges.list', ['applicator_id' => $applicator->id]) }}">Номенклатура</a>
                                |
                                <a href="{{ route('contactquery.index', ['applicator_id' => $applicator->id]) }}">Мои
                                    обращения</a> |
                                <a href="{{ route('applicators.show', ['applicator_id' => $applicator->id]) }}">{{$applicator->user->lastName ." ". $applicator->user->firstName}}</a>
                            </div>

                            <div class="default-tabs">

                                <a class="js-tab-link tabs_controls_link"
                                   href="{{route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'current']) }}">Заявки
                                    текущего месяца</a>
                                |
                                <a class="js-tab-link tabs_controls_link"
                                   href="{{route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'new']) }}">Новые</a>
                                |
                                <a class="js-tab-link tabs_controls_link"
                                   href="{{route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'completed']) }}">Выполненные</a>
                                |
                                <a class="js-tab-link tabs_controls_link"
                                   href="{{ route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'all']) }}">Все
                                    заявки</a>
                                |
                                <a class="js-tab-link tabs_controls_link"
                                   href="{{route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'noncomplete']) }}">Черновик</a>
                            </div>
                            <hr/>
                            <a class="btn btn-sm btn-success pull-right"
                               href="{{ route('applications.create', ['applicator_id' => $applicator->id]) }}">Добавить
                                новую заявку</a>
                            <div class="article">

                                @foreach($applications as $application)
                                    <div class="apps__item js-app-item">
                                        <div class="apps__inner">
                                            <span class="apps__number">Заявка №{{ $application->number }}</span>
                                            <span class="apps__date">от {{ $application->created_at->format('d.m.Y') }}</span>
                                            <div class="apps__toolbar">
                                                <div class="icon apps__icon apps__icon_copy"></div>
                                                <div class="icon apps__icon apps__icon_calendar js-calendar-show"></div>
                                            </div>
                                            <div class="apps__block apps__block_top">
                                                <div class="apps__block-col">
                                                    <div class="apps__data-title">
                                                        Поставщик
                                                    </div>
                                                    <div class="apps__data-text">
                                                        {{ $application->provider->name }}
                                                    </div>
                                                </div>
                                                <div class="apps__block-col">
                                                    <div class="apps__data-title">
                                                        Грузополучатель
                                                    </div>
                                                    <div class="apps__data-text">
                                                        {{ $application->consigneer->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="apps__block">
                                                <div class="apps__block-col">
                                                    <div class="apps__data-title">
                                                        Период отгрузки
                                                    </div>
                                                    <div class="apps__data-text">
                                                        {{$application->period}}
                                                    </div>
                                                </div>
                                                <div class="apps__block-col">
                                                    <div class="apps__data-title">
                                                        Итого по заявке
                                                    </div>
                                                    <div class="apps__data-text">
                                                        {{ $application->getApplicationVolume() }} тонн
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="apps__progress-bar">
                                                <div class="apps__progress-line apps__progress-line_online js-progress"
                                                     data-status="25" style="width: 25%;"></div>
                                                <span class="apps__progress-text">Статус {{  $application->status }}</span>
                                            </div>
                                            <div class="apps__more">
                                                <form method="POST"
                                                      action="{{ route('applications.destroy',  ['application' => $application, 'applicator' => $applicator]) }}">
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('applications.show',  ['application' => $application, 'applicator' => $applicator]) }}">show</a>
                                                    <a class="btn btn-default btn-sm"
                                                       href="{{ route('applications.edit',  ['application' => $application, 'applicator' => $applicator]) }}">edit</a>

                                                    <input type="hidden" name="_method" value="delete"/>
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                                </form>
                                            </div>
                                            <hr/>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
