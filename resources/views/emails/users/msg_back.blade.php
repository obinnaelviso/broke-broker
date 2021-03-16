@component('mail::message')
Message from contact {{ config('app.name') }} contact form.

<h5>Name</h5>
<p>{{ ucfirst($name) }}</p>

<h5>Email Address</h5>
<p>{{ $email }}</p>

<h5>Subject</h5>
<p>{{ $subject }}</p>

<h5>Message</h5>
<p>{{ $message }}</p>
@component('mail::button', ['url' => ''])
View mail on {{ config('app.name') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
