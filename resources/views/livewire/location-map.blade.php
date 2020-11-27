<div class="h-100">
    @isset($location) -{{ $location->coordinates }}- @endisset
    @map($map)
</div>

@push('styles')
    @mapstyles
    <style type="text/css">
        .gnw-map-service {
            height: 100%;
        }
    </style>
@endpush

@push('scripts')
    @mapscripts
    @unless(isset($coordinates))
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
                    map.fitBounds([
                        [maxLat, minLng],
                        [minLat, maxLng]
                    ])
                }
            });
        </script>
    @endunless
@endpush
