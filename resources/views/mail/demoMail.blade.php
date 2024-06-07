@component('mail::message')
# {{ $mailData['title'] }}

{{ $mailData['body'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
