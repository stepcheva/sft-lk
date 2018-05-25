@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    @include('flashes')

                    <div class="panel-heading">
                        <h4>Создание обращения</h4>
                    </div>

                    <div class="panel-body">
                        <div class="panel-body">
                            <form method="POST"
                                  action="{{ route('contactquery.store', ['applicator' =>$applicator]) }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                     <h4>Пользователь:
                                         {{ $applicator->user->lastName }}
                                         {{ $applicator->user->firstName }}
                                         {{ $applicator->user->middleName }}</h4>
                                </div>

                                <div class="form-group">
                                    <div>
                                        <label for="theme" class="control-label">Тема обращения</label>
                                        <input id="theme" class="form-control" name="theme"
                                                  value=" {{ old('theme') }}" required>
                                                </input>

                                        @if ($errors->has('theme'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('theme') }}</strong>
                                                 </span>
                                        @endif
                                    </div>
                                </div>
                                <div>

                                <div class="form-group">
                                    <div>
                                        <label for="querytext" class="control-label">Текст обращения</label>
                                        <textarea id="querytext" class="form-control" name="querytext"
                                                 rows="10" value="{{ old('querytext') }}" required>
                                                </textarea>

                                        @if ($errors->has('contactquery'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('contactquery') }}</strong>
                                                 </span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="pull-right">
                                        <a class="btn btn-info"
                                           href="{{ route('applicators.show', ['applicator' => $applicator]) }}">
                                            Вернуться в профиль</a>
                                        {{ method_field('POST') }}

                                        <button type="submit" class="btn btn-success">Отправить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection