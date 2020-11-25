<div>
    <h2>Map of Locations</h2>
    @isset($message)
        <x-alert type="warning" :message="$message"/>
    @endif
    @isset($map)
        {!! $map['html'] !!}
    @endisset
</div>

@push('scripts')
    @isset($map)
        <script type="text/javascript">
            var centreGot = false;
        </script>
        {!!  $map['js'] !!}
    @endisset
@endpush
