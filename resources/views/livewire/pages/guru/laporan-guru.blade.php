@extends('layouts.dashboard-layout')
@section('title', 'Buat Akun')
@section('content')

<div class="container">
    <div class="flex items-center justify-center ">
        <div class="min-w-full px-4 py-3 space-y-16 border-2">
            <div class="space-y-3">
                <div class="text-lg font-semibold text-[#0d3676]">Form laporan</div>
                <div>
                    <div class="text-[#0d3676]">Laporan</div>
                    <div class="flex justify-center min-w-full">
                        <textarea name="" class="w-full py-20 text-center placeholder-center h-52 bg-slate-100" placeholder="Laporan..."></textarea>
                    </div>
                </div>
            </div>
            <div class="flex justify-center py-3">
                <div class="w-max rounded-md bg-[#d6fc92] px-14 py-1 font-semibold transition-all hover:bg-[#c0f090] active:bg-green-100">Submit</div>
            </div>
        </div>
    </div>
</div>

<style>
    .placeholder-center::placeholder {
        text-align: center;
    }

    .placeholder-center {
        display: flex;
        align-items: center;
        justify-content: center;
        resize: none;
    }
</style>

@endsection