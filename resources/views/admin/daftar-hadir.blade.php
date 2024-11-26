@extends('layouts.dashboard-layout')
@section('title', 'Rekap Absen')
@section('content')

<div class="bg-white shadow-lg rounded-lg overflow-hidden mt-8">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">Rekap Daftar Siswa Hadir Sekolah</h2>
    </div>

    <!-- Filter Form -->
    <div class="px-6 py-4 border-b border-gray-200">
        <form method="GET" action="{{ route('rekap-absen-sekolah') }}" class="flex items-center gap-4">
            <div>
                <label for="from_date" class="block text-gray-600 text-sm">Dari Tanggal</label>
                <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label for="to_date" class="block text-gray-600 text-sm">Sampai Tanggal</label>
                <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div class="mt-5">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Filter</button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-green-100 text-left text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">No</th>
                    <th class="py-3 px-6">Nama</th>
                    <th class="py-3 px-6">Role</th>
                    <th class="py-3 px-6">Waktu Absen</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                @forelse ($absen as $key => $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $key + 1 }}</td>
                        <td class="py-3 px-6">{{ $item->user->name }}</td>
                        <td class="py-3 px-6">{{ $item->user->role }}</td>
                        <td class="py-3 px-6">
                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-3">Belum ada user hadir</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
