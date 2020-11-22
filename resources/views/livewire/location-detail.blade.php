<div>
    <h2>{{ $location->name }} <small class="text-muted">Location</small></h2>

    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif

    @if(isset($location->latitude) && isset($location->longitude))
        <p>
            <x-bi-geo-alt/>
            <a href="http://www.google.com/maps/place/{{ $location->latitude }},{{ $location->longitude }}" target="_blank">
                {{ $location->latitude }}, {{ $location->longitude }}
            </a>
        </p>
    @endif

    @isset($location->description)
        @markdown($location->description)
    @else
        <p>
            <em>No description has been provided.</em>
        </p>
    @endif

    @if($location->services->isNotEmpty())
        <h3>Services</h3>
        <ul>
            @foreach($location->services->sortBy('name') as $service)
                <li>
                    {{ $service->name }}<br>
                    <x-bi-people/> <a href="{{ route('organizations.show', $service->organization) }}">{{ $service->organization->name }}</a>
                </li>
            @endforeach
        </ul>
    @endisset

    <p>
        {{-- TODO --}}
        <a href="{{ route('locations.index') }}">Return to list of locations</a>
    </p>
</div>
