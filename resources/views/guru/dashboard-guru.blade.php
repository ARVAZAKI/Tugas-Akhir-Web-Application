@extends('layouts.dashboard-layout')
@section('title','dashboard')
@section('content')
<body>
    <div class="container mx-auto p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($mapel as $item)
            <div class="p-5 bg-white border-2 rounded-lg shadow-lg transition transform hover:scale-105">
                <div class="space-y-3 text-[#0d3676]">
                    <div class="border-b pb-2 text-lg font-bold">{{ $item->nama_mapel }}</div>
                </div>
                <div class="mt-3">
                    <form action="{{ route('list.kelas.absen', $item->id) }}" method="GET">
                        <button type="submit" class="w-full py-2 rounded-md bg-[#c0f090] text-center font-semibold text-[#0d3676] hover:bg-green-300 active:bg-green-600">
                            Cek Kelas
                        </button>
                    </form>                    
                </div>
            </div>
        @endforeach
    </div>
</body>
@endsection