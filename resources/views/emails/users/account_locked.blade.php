@component('mail::message')
Dear User,

Your account has being temporarily blocked due to security reasons.
Please hold on, we are currently working on it and it will be activated shortly.
You will receive your account details after activation.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
