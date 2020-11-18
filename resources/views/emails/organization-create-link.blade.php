@component('mail::message')
# Permission to register your organization profile

A request has been filed at <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> to create a profile for your organization.

Please click the following link to open the web form:

@component('mail::button', ['url' => $url])
Register your organization
@endcomponent

This link is valid for {{ $validityInMinutes }} minutes.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
