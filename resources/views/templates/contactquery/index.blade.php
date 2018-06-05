@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    @include('flashes')

                    <div class="panel-heading">
                        <h4>Мои обращения</h4>
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
                            </div>
                            <hr/>
                            <a class="btn btn-sm btn-success pull-right"
                               href="{{ route('contactquery.create', ['applicator_id' => $applicator->id]) }}">Добавить
                                обращение</a>
                            <div class="article">

                                @foreach($contactqueries as $contactquery)
                                    <div class="apps__item js-app-item">
                                        <div class="apps__inner">
                                            <span class="apps__number">Обращение</span>
                                            <span class="apps__date">от {{ $contactquery->created_at->format('d.m.Y') }}</span>
                                            <div class="apps__toolbar">
                                                <div class="icon apps__icon apps__icon_copy"></div>
                                                <div class="icon apps__icon apps__icon_calendar js-calendar-show"></div>
                                            </div>
                                            <div class="apps__block apps__block_top">
                                                <div class="apps__block-col">
                                                    <div class="apps__data-title">
                                                        Тема
                                                    </div>
                                                    <div class="apps__data-text">
                                                        {{ $contactquery->theme }}
                                                    </div>
                                                </div>
                                                <div class="apps__block-col">
                                                    <div class="apps__data-title">
                                                        Текст
                                                    </div>
                                                    <div class="apps__data-text">
                                                        {{  $contactquery->querytext }}
                                                    </div>
                                                </div>
                                                @isset( $contactquery->file)
                                                <div class="apps__block-col">
                                                    <div class="apps__data-title">
                                                        Файл
                                                    </div>
                                                    <div class="apps__data-text">
                                                        <a href="{{  $contactquery->file->path }}">{{$contactquery->file->name}}</a>
                                                    </div>
                                                </div>
                                                @endisset
                                            </div>

                                            <div class="apps__more">
                                                <form method="POST"
                                                      action="{{ route('contactquery.destroy',  ['contactquery' => $contactquery, 'applicator' => $applicator]) }}">
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('contactquery.edit',  ['contactquery' => $contactquery, 'applicator' => $applicator]) }}">edit</a>
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
