@extends('layouts.dashboard-layout')
@section('title', 'Buat Akun')
@section('content')

<div class="container">
    <div class="p-4 my-3 border-2 rounded-md md:flex md:justify-center">
        <div class="space-y-2 border-b-2 md:w-3/4 md:space-y-8 md:border-b-0 md:border-r-2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15830.767908111202!2d112.7937557!3d-7.2758471!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa10ea2ae883%3A0xbe22c55d60ef09c7!2sPoliteknik%20Elektronika%20Negeri%20Surabaya!5e0!3m2!1sid!2sid!4v1729870306969!5m2!1sid!2sid" width="" height="" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full"></iframe>
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

@endsection