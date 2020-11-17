@component('mail::message')
# Permission to edit your organization profile

A request has been filed at <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> to edit the profile of your organization  <strong>{{ $organization->name }}</strong>.

Please click the following link to open the web form:

@component('mail::button', ['url' => $url])
Edit your organization
@endcomponent

This link is valid for {{ $validityInMinutes }} minutes.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
