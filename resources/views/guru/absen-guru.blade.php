@extends('layouts.dashboard-layout')
@section('title','dashboard')
@section('content')
<div>
    <div class="container">
        <div class="p-4 my-3 border-2 rounded-md md:flex md:justify-center">
            <div class="space-y-2 border-b-2 md:w-3/4 md:space-y-8 md:border-b-0 md:border-r-2">
                <div class="flex items-center gap-2 py-2 text-lg font-semibold">
                    <div class="">Nama Guru:</div>
                    <div class="">Lorem Ipsum</div>
                </div>
                <div class="flex items-center gap-2 py-2 text-lg font-semibold">
                    <div class="">Jumlah siswa hadir:</div>
                    <div class="">255</div>
                </div>
            </div>
            <div class="my-1 space-y-4 lg:maxw md:mx-5">
                <div class="space-y-2">
                    <div class="h-full w-full rounded-xl bg-[#d6fc92] py-2 text-center font-semibold transition-all hover:bg-[#c0f090] active:bg-green-100 lg:w-64">Buka Presensi</div>
                    <div class="h-full w-full rounded-xl bg-[#fb5c3c] py-2 text-center font-semibold text-white transition-all hover:bg-[#e16143] active:bg-red-100 lg:w-64">Tutup presensi</div>
                </div>
                <div class="w-full h-full py-2 font-semibold text-center">Aturan presensi</div>
            </div>
        </div>
    </div>
</div>
@endsection