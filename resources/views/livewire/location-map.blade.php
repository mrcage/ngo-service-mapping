<div>
    <h2>Map of Locations</h2>
    @isset($message)
        <x-alert type="warning" :message="$message"/>
    @endif
    @map($map)
</div>

@push('styles')
    @mapstyles
@endpush

@push('scripts')
    @mapscripts
@endpush
