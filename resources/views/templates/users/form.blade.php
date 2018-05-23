@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    @include ('flashes')

                    <div class="panel-heading">
                        @if(isset($user))
                            Редактирование пользователя:
                        @else
                            Создание пользователя:
                        @endif
                    </div>


                    <div class="panel-body">
                        @if(isset($user))
                            <form class="form-horizontal" method="POST" action="{{ route('users.update', ['user' => $user]) }}">
                        @else
                            <form class="form-horizontal" method="POST" action="{{ route('users.store') }}">
                        @endif

                                {{ csrf_field() }}

                            <div class="form-group">
                                <label for="lastName" class="col-md-4 control-label">Фамилия:</label>
                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control" name="lastName" placeholder="Введите фамилию" value="{{ isset($user->lastName) ?  $user->lastName : old('lastName')}}" required>

                                    @if ($errors->has('lastName'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                                <div class="form-group">
                                    <label for="firstName" class="col-md-4 control-label">Имя:</label>
                                    <div class="col-md-6">
                                        <input id="firstName" type="text" class="form-control" name="firstName" placeholder="Введите имя" value="{{ isset($user->firstName) ?  $user->firstName : old('firstName')}}" required>

                                        @if ($errors->has('firstName'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('firstName') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="middleName" class="col-md-4 control-label">Отчество:</label>
                                    <div class="col-md-6">
                                        <input id="middleName" type="text" class="form-control" name="middleName" placeholder="Введите отчество" value="{{ isset($user->middleName) ?  $user->middleName : old('middleName') }}" required>

                                        @if ($errors->has('middleName'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('middleName') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-md-4 control-label">Телефон:</label>
                                    <div class="col-md-6">
                                        <input id="phone" type="tel" class="form-control" name="phone" placeholder="+71234567890" value="{{ isset($user->phone) ?  $user->phone : old('phone') }}" required>

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">E-mail:</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" placeholder="abs@abcdef.ru" value="{{ isset($user->email) ?  $user->email :  old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Пароль:</label>
                                    <div class="col-md-6">
                                        <input id="password" type="text" class="form-control" name="password" placeholder="abc12345" value="{{ isset($user->password) ?  $user->password : old('password') }}" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @isset($user)
                                <div class="form-group">
                                    <label for="passwordUntil" class="col-md-4 control-label">Действителен до:</label>
                                    <div class="col-md-6">

                                            @if(isset($user->password))
                                                <h5> {{ $user->passwordUntil }} </h5>
                                            @else
                                                <input id="passwordUntil" type="date" class="form-control" name="passwordUntil" placeholder="Введите дату окончания действия пароля" value="{{ old('passwordUntil') }}" required>
                                            @endif

                                        @if ($errors->has('passwordUntil'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('passwordUntil') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @endisset

                                <div class="form-group">
                                <label for="counter_id" class="col-md-4 control-label">Контрагент</label>
                                    <div class="col-md-6">

                                    @if(isset($user) && $user->counter->id)
                                        <div class="accordion">
                                            <div class="accordion-toggle">
                                                {{ $user->counter->name }}
                                                <a data-toggle="collapse" data-parent="#collapse-group"
                                                   href="#1">Изменить контрагента</a>
                                                <div id="1" class="panel-collapse collapse">
                                                    <div >
                                                        <div >
                                                            @isset($counters)
                                                                <select name="counter_id" class="form-control">
                                                                    @foreach($counters as $counter)
                                                                        <option value="{{ $counter->id }}">{{ $counter->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endisset
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @isset($counters)
                                            <select name="counter_id" class="form-control">
                                                @foreach($counters as $counter)
                                                    <option value="{{ $counter->id }}">{{ $counter->name }}</option>
                                                @endforeach
                                            </select>
                                        @endisset
                                    @endif

                                    @if ($errors->has('counter_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('counter_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    @isset($user)
                                        {{ method_field('PUT') }}
                                        <button type="submit" class="btn btn-primary">Изменить</button>
                                    @else
                                        {{ method_field('POST') }}
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    @endisset
                                    <a href="{{ route('users.index') }}" class="cancel">Отмена</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
