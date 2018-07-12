@extends('layouts.master')

@section('title', "Авторизация")

@section('content')

@include('flashes')

	<h1>Авторизация</h1>
	<div class="login">
		<form action="{{ route('login') }}" method="POST" class="form">
				{{ csrf_field() }}
			<fieldset class="form__fieldset">
				<input type="email" name="email" class="form__input form__input_large" placeholder="Введите логин" required="required">
			</fieldset>			
			<fieldset class="form__fieldset">
				<input type="password" name="password" class="form__input form__input_large" placeholder="Введите пароль" required="required">
			</fieldset>
			<div class="flex login__toolbar">
				<a href="{{ route('password.request') }}" class="login__recover-pass">Забыли пароль?</a>
				<div class="login__btn-wrap">
					<button class="btn login__btn btn_full" type="submit">Войти</button>
				</div>
			</div>
		</form>
	</div>
@endsection


