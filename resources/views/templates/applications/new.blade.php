@extends('layouts.master')

@section('title', "Новая заявка")

@section('content')

    @include('flashes')
    <h1 class="ai-title">Новая заявка</h1>
    <div class="a-body">
        <form id='step1' action="route('applications.store', ['applicator' => $applicator]) }}" class="form" method="POST">
            {{ csrf_field() }}
            <div class="js-step app-new-step active">
                <div class="a-title a-title_mb">
                    <div class="a-title__h3">Информация по заявке</div>
                </div>
                <div class="anew-form-wrapper">
                    <fieldset class="form__fieldset">
                        <div class="info-title">Период отгрузки</div>
                        <div class="flex date">
                            <div class="date__month">
                                <select name="date_month" class="js-default-select form__select-large">
                                    @foreach($date_month as $month)
                                        <option value="{{ $month }}" placeholder="Месяц">
                                            @if(App::isLocale('ru'))
                                                @lang("dates.month.$month")
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="date__year">
                                <select name="date_year" class="js-default-select form__select-large">
                                    @foreach($date_year as $year)
                                        <option value="{{ $year }}" placeholder="Год">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form__fieldset form__fieldset_mb">
                        <div class="info-title">Получатель</div>
                        @if($applicator->getConsigneers())
                            <select name="consigneer_id" class="js-default-select form__select-large">
                                @foreach($applicator->getConsigneers() as $consigneer)
                                    <option value="{{ $consigneer->id }}">{{ $consigneer->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </fieldset>
                    <fieldset class="form__fieldset">
                        <div class="info-title">Поставщик</div>
                        @if($applicator->counter->providers)
                            <select name="provider_id" class="js-default-select form__select-large">
                                @foreach($applicator->counter->providers as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </fieldset>
                    <div class="anew-next">
                        <button type="submit" class="btn btn_next">Далее</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
