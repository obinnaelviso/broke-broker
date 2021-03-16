@component('mail::message')
Dear Admin,

A new user has just registered.
<br><br>
Below are the details:
<br><br>
Name: {{ $data->first_name.' '.$data->last_name }}
<br>
Email Address: {{ $data->email }}
<br><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
