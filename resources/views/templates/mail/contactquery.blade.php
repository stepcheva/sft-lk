<h1>Добрый день!</h1>
<p>Новое обращение в личном кабинете:

<p>Тема: {{ $theme }}</p>
<p>Сообщение: {{ $querytext }}</p>

@if($fileName || $filePath)
	<p>Файл: <a href= "{{ $filePath }}">{{ $fileName }}</a></p>
@endif

<hr />
<p>P.S. Письмо сгененировано автоматически. Не отвечайте на это письмо.</p>