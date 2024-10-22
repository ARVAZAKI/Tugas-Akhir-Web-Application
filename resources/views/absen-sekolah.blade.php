@extends('layouts.dashboard-layout')
@section('title','dashboard')
@section('content')
<div>
    <div class="container">
        <div class="p-4 my-3 border-2 rounded-md md:flex md:justify-center">
            <div class="space-y-2 border-b-2 md:w-3/4 md:space-y-8 md:border-b-0 md:border-r-2">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
            <div class="my-1 space-y-4 lg:maxw md:mx-5">
                <div class="space-y-2">
                    <form id="lokasiForm" method="POST" action="{{ route('handle-absen-sekolah') }}">
                        @csrf
                        <input type="hidden" name="lokasi" id="lokasi">
                        <button type="submit" 
                            @if($statusAbsen) 
                                disabled 
                                class="h-full w-full rounded-xl bg-gray-300 py-2 text-center font-semibold cursor-not-allowed lg:w-64"
                            @else
                                class="h-full w-full rounded-xl bg-[#d6fc92] py-2 text-center font-semibold transition-all hover:bg-[#c0f090] active:bg-green-100 lg:w-64"
                            @endif
                        >
                            @if($statusAbsen)
                                Sudah Presensi Hari Ini
                            @else
                                Presensi
                            @endif
                        </button>
                    </form>
                </div>
                <div class="w-full h-full py-2 font-semibold text-center">Aturan presensi</div>
            </div>
        </div>
    </div>
</div>

<script>
    // Membuat peta dengan Leaflet.js
    var map = L.map('map', {
        center: [0, 0],
        zoom: 13,
        scrollWheelZoom: false,
        dragging: false,
        touchZoom: false,
        doubleClickZoom: false,
        boxZoom: false,
        keyboard: false
    });

    // Menambahkan tile layer ke peta
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Memeriksa apakah browser mendukung Geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            map.setView([lat, lng], 13);

            // Tambahkan marker ke lokasi user
            L.marker([lat, lng]).addTo(map)
                .bindPopup("Lokasi Anda Saat Ini")
                .openPopup();

            // Set value input hidden dengan lokasi (latitude,longitude)
            document.getElementById('lokasi').value = lat + ',' + lng;
        });
    } else {
        alert("Geolocation tidak didukung oleh browser ini.");
    }
</script>
@endsection