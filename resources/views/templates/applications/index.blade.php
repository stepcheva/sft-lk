@extends('layouts.master')

@section('title', "Мои заявки")

@section('content')

    @include('flashes')

    <h1 class="ai-title">Мои заявки</h1>
    <div class="default-tabs">
        <ul class="tabs_controls">
            @include('templates.applications.sub_menu')
        </ul>
        <ul class="tabs_list">
            <li class="tabs_item active">
                <div class="apps">
                    <div class="apps__item js-app-item apps__item_new" >
                        <div class="apps__inner-new" min-height = "500">
                            <a class="apps__add-link js-add-new-app" href="{{ route("applications.create", ['applicator' => $applicator ]) }}">
                                <i class="icon apps__new-icon"></i>
                                <span class="apps__add-text">Добавить новую заявку</span>
                            </a>
                        </div>
                    </div>

                    @foreach($applications as $application)
                    <div class="apps__item js-app-item">
                            <div class="apps__inner">
                                <span class="apps__number">Заявка №{{ $application->number }}</span>
                                <span class="apps__date">от {{ $application->created_at->format('d.m.Y') }}</span>
                                <div class="apps__toolbar">
                                    <a href="{{ route('applications.duplicate', ['application' => $application]) }}" class="icon apps__icon apps__icon_copy"></a>
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
                                    @if(in_array($application->status, ['on review', 'in planning', 'confirmed']))
                                    <div class="apps__progress-line apps__progress-line_review js-progress" data-status="100" style="width: 100%;"></div>
                                    @elseif($application->status === 'done')
                                    <div class="apps__progress-line apps__progress-line_online js-progress"
                                         data-status="100" style="width: 100%;"></div>
                                    @elseif($application->status === 'in progress')
                                     <div class="apps__progress-line apps__progress-line_online js-progress"
                                         data-status="25" style="width: 25%;"></div>
                                    @endif
                                    <span class="apps__progress-text">Статус
                                        @if(App::isLocale('ru'))
                                            @lang("applications.status.$application->status")
                                        @endif
                                    </span>
                                </div>
                                <div class="apps__more">
                                    <form method="POST" action="{{ route('applications.destroy',  ['application' => $application, 'applicator' => $application->applicator ]) }}">
                                        <input type="hidden" name="_method" value="delete"/>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button type="submit">Удалить заявку</button>
                                    </form>
                                    <a class="apps__details-btn" href="{{ route('applications.show',  ['application' => $application, 'applicator' => $applicator]) }}">Детали заявки</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
    @include('templates.applications.calendar')
@endsection

@section('hidden')
    @include('templates.applications.shipments')
@endsection