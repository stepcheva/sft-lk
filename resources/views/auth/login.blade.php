@extends('layouts.master')

@section('title', "Авторизация")

@section('content')

@include('flashes')

	<h1>Авторизация</h1>
	<div class="login">
		<form action="{{ route('login') }}" method="POST" class="form">
				{{ csrf_field() }}
			<fieldset class="form__fieldset">
				<input type="text" class="form__input form__input_large" placeholder="Введите логин" required="required">
			</fieldset>			
			<fieldset class="form__fieldset">
				<input type="password" class="form__input form__input_large" placeholder="Введите пароль" required="required">
			</fieldset>
			<div class="flex login__toolbar">
				<a href="#recoverPass" class="js-modal login__recover-pass">Забыли пароль?</a>
				<div class="login__btn-wrap">
					<button class="btn login__btn btn_full" type="submit">Войти</button>
				</div>
			</div>
		</form>
	</div>
@endsection

@section('hidden')
<div class="hidden">
	<div id="recoverPass" class="popup">
		<div class="flex popup__flex">
			<h3 class="popup__title pass-popup__title">Восстановление пароля</h3>
			<div class="popup-close close-btn js-close-modal"></div>
		</div>
		<form action="" class="form">
			<fieldset class="form__fieldset">
				<div class="info-title">Введите ваш E-mail</div>
				<input type="text" class="form__input" required="required">
			</fieldset>
			<div class="popup__toolbar">
				<button class="btn btn_recover btn_full" type="submit">Восстановить</button>
			</div>
		</form>
	</div>
</div>
@endsection
