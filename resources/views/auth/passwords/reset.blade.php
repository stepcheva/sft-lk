@extends('layouts.master')

@section('title', "Смена пароля")

@section('content')

    @include('flashes')

    <h1>Смена пароля</h1>
    <div class="login">
        <form class="form" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <fieldset class="form__fieldset">
                <input type="email" name="email" class="form__input form__input_large{{ $errors->has('email') ? ' form__input_alert' : '' }}" placeholder="E-mail" value="{{ $email or old('email') }}" required="required">
                @if ($errors->has('email'))
                    <span class="pf-alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </fieldset>

            <fieldset class="form__fieldset">
                <input type="password" name="password" class="form__input  form__input_large{{ $errors->has('password') ? ' form__input_alert' : '' }}" placeholder="Новый пароль" required="required">
                @if ($errors->has('password'))
                    <span class="pf-alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </fieldset>

            <fieldset class="form__fieldset">
                <input type="password" name="password_confirmation" class="form__input form__input_large{{ $errors->has('password_confirmation') ? ' form__input_alert' : '' }}" placeholder="Подтвердите пароль" required="required">
                @if ($errors->has('password_confirmation'))
                    <span class="pf-alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </fieldset>

            <div class="flex login__toolbar">
                <div class="login__btn-wrap">
                    <button class="btn login__btn btn_full" type="submit">Сменить пароль</button>
                </div>
            </div>
        </form>
    </div>
@endsection








