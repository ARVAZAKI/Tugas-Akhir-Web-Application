@extends('layouts.dashboard-layout')
@section('title','List Kelas')
@section('content')
<body>
    <div class="container mx-auto p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($kelas as $item)
    @foreach ($item->mapel as $mapel)
    <div class="p-5 bg-white border-2 rounded-lg shadow-lg transition transform hover:scale-105">
        <div class="space-y-3 text-[#0d3676]">
            <div class="border-b pb-2 text-lg font-bold">{{$mapel->nama_mapel}}</div>
        </div>
        <form action="{{route('absen.mapel.student', $mapel->id)}}" method="GET">
            <button type="submit" class="w-full py-2 rounded-md bg-[#c0f090] text-center font-semibold text-[#0d3676] hover:bg-green-300 active:bg-green-600">
                Absen
            </button>
        </form>
    </div>
    @endforeach
@endforeach
    </div>
</body>
@endsection
