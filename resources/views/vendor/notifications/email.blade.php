@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
    @if(App::isLocale('ru'))
        # @lang("notifications.greeting.error")
    @endif
@else
    @if(App::isLocale('ru'))
        # @lang("notifications.greeting.success")
    @endif
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $key => $line)
    @if(App::isLocale('ru'))
        @lang("notifications.password.introLines.$key")
    @else
        {{ $line }}
    @endif
@endforeach

{{-- Action Button --}}
@isset($actionText)
@php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
@endphp

@component('mail::button', ['url' => $actionUrl, 'color' => $color])
    @if(App::isLocale('ru'))
        @lang("notifications.password.actionText.$actionText")
    @else
        {{ $actionText }}
    @endif
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $key => $line)
    @if(App::isLocale('ru'))
        @lang("notifications.password.outroLines.$key")
    @else
        {{ $line }}
    @endif
@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Regards,<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
If you’re having trouble clicking the "{{ $actionText }}" button, copy and paste the URL below
into your web browser: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
