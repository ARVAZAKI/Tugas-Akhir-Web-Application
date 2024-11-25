<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
      
<div class="container mx-auto my-4 p-4">
    <div class="mb-5">
        <a href="/"
           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-[#0d3676] rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5 mr-2" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor">
                <path stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
      </div>
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
              @if ($errors->any())
    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
        <strong>Whoops! Something went wrong.</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  
              {{-- Form Presensi --}}
              <form id="lokasiForm" method="POST" action="{{ route('handle-kunjungan') }}">
                  @csrf
                  <div class="space-y-4">
                        <div>
                          <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                          <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                          <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                          <input type="text" name="keperluan" id="keperluan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                      </div>
                      
                  <input type="hidden" name="lokasi" id="lokasi">
                  <button type="submit" 
                          class="w-full mt-3 bg-green-400 text-white text-center font-semibold py-3 rounded-lg hover:bg-green-500 transition duration-150 ease-in-out"
                  >Submit
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
  
</body>
</html>