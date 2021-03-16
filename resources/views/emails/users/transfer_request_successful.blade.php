@component('mail::message')
Hi {{ ucfirst($data->first_name.' '.$data->last_name) }},
<br><br>
Your transfer request was sent successfully!
<br>
Below is the details of your transfer:
<br><br>
Ref No: {{ strtoupper($data->reference_no->reference_no) }}
<br>
Bank Name: {{ $data->bank_name }}
<br>
Account Name: {{ $data->acc_name }}
<br>
Amount: {{ $data->amount }}
<br>
Account Number: {{ $data->acc_no }}
<br>
Account type: {{ ucfirst($data->acc_type) }}
<br>
Transfer type: {{ ucfirst($data->transfer_type) }}
<br><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
