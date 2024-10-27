@extends('layouts.dashboard-layout')
@section('title', 'Buat Akun')
@section('content')

<div>
    <div class="container md:grid md:grid-cols-3 md:gap-3">
        @foreach ($guru as $data)
        <div class="p-3 my-3 space-y-4 border-2 rounded-md">
            <div class="space-y-2 text-[#0d3676]">
                <div class="border-b">{{ $data['mata_kuliah'] }}</div>
                <div>{{ $data['kelas'] }}</div>
            </div>
            <div>
                <div class="h-full w-full rounded-md bg-[#c0f090] py-2 text-center font-semibold hover:bg-green-300 active:bg-green-600">Absensi</div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection