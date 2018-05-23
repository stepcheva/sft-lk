@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    @include ('flashes')

                    <div class="panel-heading">
                        Новая заявка
                    </div>

                    <div class="panel-body">
                        <p>Информация по заявке</p>
                        <form class="form-horizontal" method="POST" action="{{ route('applications.store', ['applicator' => $applicator]) }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="period" class="col-md-4 control-label">Период отгрузки</label>
                                <div class="col-md-4">
                                    @if($date_month)
                                        <select name="month" class="form-control">
                                            @foreach($date_month as $month)
                                                <option value="{{ $month }}" placeholder="Месяц">
                                                    @if(App::isLocale('ru'))
                                                         @lang("dates.month.$month")
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>

                                <div class="col-md-2">
                                    @if($date_year)
                                        <select name="year" class="form-control">
                                            @foreach($date_year as $year)
                                                <option value="{{ $year }}" placeholder="Год">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="consigneer_id" class="col-md-4 control-label">Грузополучатель</label>
                                <div class="col-md-6">
                                    @if($applicator->getConsigneers())
                                        <select name="consigneer_id" class="form-control">
                                            @foreach($applicator->getConsigneers() as $consigneer)
                                                <option value="{{ $consigneer->id }}">{{ $consigneer->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    @if ($errors->has('consigneer_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('consigneer_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="provider_id" class="col-md-4 control-label">Поставщик</label>
                                <div class="col-md-6">
                                    @if($applicator->counter->providers)
                                        <select name="provider_id" class="form-control">
                                            @foreach($applicator->counter->providers as $provider)
                                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    @if ($errors->has('provider_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('provider_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Далее</button>
                                    <a href="{{ route('applicators.show', ['applicator' => $applicator]) }}" class="cancel">Отмена</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
