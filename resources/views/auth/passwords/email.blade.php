@extends('layouts.master')

@section('title', "Восстановление пароля")

@section('content')
    <div class="login popup">
            @if (session('status'))
                <div id="status" class="popup">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    <div class="popup__toolbar">
                        <a href="{{ route('login') }}" class="btn btn_small btn_inversed js-close-modal">Закрыть</a>
                    </div>
                </div>
            @else
                <div class="flex popup__flex">
                    <h3 class="popup__title pass-popup__title">Восстановление пароля</h3>
                    <a href="{{ route('login') }}" class="popup-close close-btn js-close-modal"></a>
                </div>
                <form class="form" action="{{ route('password.email') }}" method="POST">
                    <fieldset class="form__fieldset">
                        <div class="info-title">Введите ваш E-mail</div>
                        <input type="text" class="form__input" name="email" value="{{ $email or old('email') }}" required="required">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </fieldset>
                    <div class="popup__toolbar">
                        <button class="btn btn_recover btn_full" type="submit">Восстановить</button>
                    </div>
                </form>
            @endif
@endsection
