@component('mail::message')
Here is your OTP: {{ $data }}. Please don't disclose this information to anybody.
<br><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
