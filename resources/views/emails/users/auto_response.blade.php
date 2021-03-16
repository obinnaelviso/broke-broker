@component('mail::message')
Dear {{ ucfirst($name) }}

We've just received an email from you through our contact form.
Please be patient, we'll respond to you shortly.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
