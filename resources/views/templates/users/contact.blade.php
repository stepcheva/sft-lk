@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    @include('flashes')

                    <div class="panel-heading">
                        <h4>
                        @if(isset($contactquery))
                            Редактирование обращения
                        @else
                            Создание обращения
                        @endif
                        </h4>
                    </div>

                    <div class="panel-body">
                        <div class="panel-body">

                            @if(isset($contactquery))
                                <form class="form-horizontal" method="POST" action="{{ route('contactquery.update',['applicator' => $applicator, 'contactquery' => $contactquery] ) }}">
                            @else
                                <form class="form-horizontal" method="POST" action="{{ route('contactquery.store',['applicator' => $applicator]) }}"  enctype="multipart/form-data">
                            @endif

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
                                                  value=" {{ isset($contactquery->theme) ?  $contactquery->theme : old('theme') }}" required>

                                        @if ($errors->has('theme'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('theme') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div>
                                        <label for="querytext" class="control-label">Текст обращения</label>
                                        <textarea id="querytext" class="form-control" name="querytext"
                                                 rows="10" value="" required>{{ isset($contactquery->querytext) ?  $contactquery->querytext : old('querytext') }}
                                        </textarea>

                                        @if ($errors->has('querytext'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('querytext') }}</strong>
                                                 </span>
                                        @endif
                                    </div>
                                </div>

                                    <div class="form-group">
                                        <div>
                                            @if(isset($file))
                                                Файл:
                                                <a href="{{$file}}"> {{$contactquery->file->name}}</a>
                                            @else
                                                <input id="file" type="file" class="form-control" name="file" value="{{ isset($file) ?  $contactquery->file->name : old('file') }}" >
                                                    @if ($errors->has('file'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('file') }}</strong>
                                                         </span>
                                                    @endif
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">

                                            <a href="{{ route('applicators.show', ['applicator' => $applicator]) }}" class="cancel">Отмена</a>

                                            @isset($contactquery)
                                                {{ method_field('PUT') }}
                                                <button type="submit" class="btn btn-primary">Изменить</button>
                                            @else
                                                {{ method_field('POST') }}
                                                <button type="submit" class="btn btn-primary">Отправить</button>
                                            @endisset
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