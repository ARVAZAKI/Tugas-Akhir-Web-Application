@extends('layouts.dashboard-layout')
@section('title','izin')
@section('content')
<div>
    <div class="container">
        <div class="flex items-center justify-center h-screen">
            <div class="min-w-full px-4 py-3 space-y-8 border-2 rounded-lg shadow-lg">
                @if ($errors->any())
                    <div class="bg-red-200 text-red-800 px-4 py-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-200 text-green-800 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{route('create-laporan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-5">
                        <div class="text-lg font-semibold text-[#0d3676]">Form Laporan</div>

                        {{-- Input File Surat Izin --}}
                        <div>
                            <label class="block text-[#0d3676] mb-2">Upload Foto</label>
                            <div class="flex justify-center">
                                <input type="file" name="foto" class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-[#d6fc92] file:text-[#0d3676]
                                hover:file:bg-[#c0f090]" required />
                            </div>
                        </div>

                        {{-- Keterangan --}}
                        <div>
                            <label class="block text-[#0d3676] mb-2">Keterangan</label>
                            <div class="flex justify-center">
                                <textarea name="keterangan" class="w-full py-2 bg-slate-100 border border-gray-300 rounded-md" placeholder="Keterangan..." required></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-center py-3">
                        <button type="submit" class="w-max rounded-md bg-[#d6fc92] px-14 py-2 font-semibold transition-all hover:bg-[#c0f090] active:bg-green-100">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
