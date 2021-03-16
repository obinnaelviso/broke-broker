@component('mail::message')
Hi {{ ucfirst($data->first_name.' '.$data->last_name) }},
<br><br>
Your account has being activated successfully!
<br>
Below is your account details:
<br><br>
Email Address: {{ $data->email }}
<br>
Account Number: {{ $data->acc_no }}
<br>
Account Type: {{ $data->acc_type }}
<br>
Your Transaction Pin: {{ $data->transaction_pin }}
<br><br>
You can now <a href="{{ url("/login") }}">login</a> into your account.
<br><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
