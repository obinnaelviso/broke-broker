@component('mail::message')
	<p>{{ $subject }}</p><br><br>
	{!! $message !!}

<br> <br>
From, <b style="color: darkorange">{{ config('app.name') }}</b>.
@endcomponent
