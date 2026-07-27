@component('mail::message')
# New Newsletter Subscriber

A new user has subscribed to the newsletter on the website.

**Email:** {{ $email }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
