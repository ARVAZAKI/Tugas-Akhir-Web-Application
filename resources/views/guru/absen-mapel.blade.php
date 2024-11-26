@extends('layouts.dashboard-layout')
@section('title','absen mapel')
@section('content')
<style>
    button:disabled {
    cursor: not-allowed;
    background-color: #d1d5db; /* Warna abu-abu */
    color: #9ca3af; /* Warna teks lebih terang */
}

</style>
@if (session()->has('message'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md shadow-md transition-all duration-500 ease-in-out transform hover:scale-105">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium">{{ session('message') }}</p>
        </div>
    </div>
</div>
@endif
<div class="mb-5">
  <a href="/guru/absen-mapel/{{$mapel->id}}" 
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
<div class="flex flex-col p-4 mt-10 space-y-2 bg-white shadow-lg rounded-lg max-w-2xl mx-auto border border-gray-200">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center text-blue-700 font-semibold">
        <span>{{ $mapel->nama_mapel }} - {{ $kelas->nama_kelas }}</span>
        <span id="currentDate" class="text-gray-500 mt-2 md:mt-0"></span>
    </div>
    
    <!-- Main Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 border border-gray-200 rounded-lg mt-4">
        <!-- Left side with teacher name and student count -->
        <div class="flex flex-col p-4 space-y-2">
            <div>
                <span class="font-medium">Jumlah siswa hadir hari ini: {{$jumlahAbsen}}</span> 
            </div>
        </div>
        
        <!-- Right side with buttons -->
        <div class="flex flex-col p-4 space-y-2 items-center justify-center border-t md:border-t-0 md:border-l border-gray-200">
            <form action="{{ route('absen.open', ['mapelId' => $mapel->id, 'kelasId' => $kelas->id]) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="px-4 py-2 w-full md:w-auto bg-lime-200 text-black font-medium rounded-md"
                        {{ $statusAbsen->status_absen === 'open' ? 'disabled' : '' }}>
                    Buka Presensi
                </button>
            </form>
                   

            <form action="{{ route('absen.close', ['mapelId' => $mapel->id, 'kelasId' => $kelas->id]) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 w-full md:w-auto bg-red-400 text-white font-medium rounded-md"  {{ $statusAbsen->status_absen === 'closed' ? 'disabled' : '' }}>
                    Tutup Presensi
                </button>
            </form>

            <a href="{{ route('rekap-absen-siswa', ['mapelId' => $mapel->id, 'kelasId' => $kelas->id]) }}" 
                class="px-4 py-2 w-full md:w-auto bg-green-400 text-white font-medium rounded-md">
                Rekap Absen
             </a>
             
        </div>
    </div>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden mt-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Siswa Hadir</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-green-100 text-left text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6">No</th>
                        <th class="py-3 px-6">Nama Siswa</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @forelse ($muridHadir as $murid) <!-- Fix: $muridHadir is a collection of AbsenMapel models -->
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6">{{ $murid->user->name }}</td> <!-- Accessing user relationship -->
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center py-3">Belum ada siswa hadir</td>
                    </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>
    </div>
    
    
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dateElement = document.getElementById("currentDate");
        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        const now = new Date();
        const dayName = days[now.getDay()];
        const day = now.getDate();
        const monthName = months[now.getMonth()];
        const year = now.getFullYear();

        dateElement.textContent = `${dayName}, ${day} ${monthName} ${year}`;
    });
</script>

@endsection