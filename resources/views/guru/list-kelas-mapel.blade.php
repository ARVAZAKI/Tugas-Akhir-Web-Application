@extends('layouts.dashboard-layout')
@section('title','List Kelas')
@section('content')
<body>
    <div class="mb-5">
        <a href="/guru/" 
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
    <div class="container mx-auto p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($mapel->kelas as $item)
        <div class="p-5 bg-white border-2 rounded-lg shadow-lg transition transform hover:scale-105">
            <div class="space-y-3 text-[#0d3676]">
                <div class="border-b pb-2 text-lg font-bold">{{$item->nama_kelas}}</div>
            </div>
            <form action="{{ route('absen.mapel', ['mapelId' => $mapel->id, 'kelasId' => $item->id]) }}" method="GET">
                <button type="submit" class="w-full py-2 rounded-md bg-[#c0f090] text-center font-semibold text-[#0d3676] hover:bg-green-300 active:bg-green-600">
                    Cek Kelas
                </button>
            </form>
        </div>
    @endforeach
    </div>
</body>
@endsection
