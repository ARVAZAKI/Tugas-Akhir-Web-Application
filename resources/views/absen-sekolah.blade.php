@extends('layouts.dashboard-layout')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto my-4 p-4">
    <div class="flex flex-col md:flex-row bg-white p-6 rounded-lg shadow-md space-y-4 md:space-y-0 md:space-x-4">
        
        {{-- Map Section --}}
        <div class="md:w-2/3">
            <div id="map" style="height: 400px; width: 100%;" class="rounded-lg border"></div>
        </div>

        {{-- Presensi Form Section --}}
        <div class="md:w-1/3 flex flex-col justify-center space-y-6">
            {{-- Alert untuk pesan error atau sukses --}}
            @if(session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Form Presensi --}}
            <form id="lokasiForm" method="POST" action="{{ route('handle-absen-sekolah') }}">
                @csrf
                <input type="hidden" name="lokasi" id="lokasi">
                <button type="submit" 
                    @if($statusAbsen) 
                        disabled 
                        class="w-full bg-gray-300 text-center font-semibold py-3 rounded-lg cursor-not-allowed"
                    @else
                        class="w-full bg-green-400 text-white text-center font-semibold py-3 rounded-lg hover:bg-green-500 transition duration-150 ease-in-out"
                    @endif
                >
                    @if($statusAbsen)
                        Sudah Presensi Hari Ini
                    @else
                        Presensi
                    @endif
                </button>
            </form>

            {{-- Aturan presensi --}}
            <div class="text-center font-semibold">
                Aturan Presensi: Pastikan Anda berada dalam radius yang ditentukan dari lokasi sekolah.
            </div>
        </div>
    </div>
</div>

<script>
    // Membuat peta dengan Leaflet.js
    var map = L.map('map', {
        center: [0, 0], // Initial center
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
