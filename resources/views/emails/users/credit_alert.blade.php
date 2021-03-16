@component('mail::message')
<br><br>
Your {{ config('app.name') }} account has been creditted successfully with {{ config('app.name') }}.<br>
Please click this <a href="{{ config('app.url') }}/login" target="_blank">link</a> to confirm entry at {{ config('app.name') }}.<br>
<br><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
