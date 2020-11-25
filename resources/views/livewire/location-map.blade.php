<div>
    <h2>Map of Locations</h2>
    @map($map)
</div>

@push('styles')
    @mapstyles
@endpush

@push('scripts')
    @mapscripts
    <script>
        window.addEventListener('LaravelMaps:MapInitialized', function (event) {
            var element = event.detail.element;
            var map = event.detail.map;
            var markers = event.detail.markers;
            if (markers.length > 0) {
                var minLat = markers.reduce((a, b) => Math.min(a, b.getLatLng().lat), 90);
                var maxLat = markers.reduce((a, b) => Math.max(a, b.getLatLng().lat), -90);
                var minLng = markers.reduce((a, b) => Math.min(a, b.getLatLng().lng), 180);
                var maxLng = markers.reduce((a, b) => Math.max(a, b.getLatLng().lng), -180);
                map.fitBounds([ // flyToBounds
                    [maxLat, minLng],
                    [minLat, maxLng]
                ])
            }
        });
    </script>
@endpush
