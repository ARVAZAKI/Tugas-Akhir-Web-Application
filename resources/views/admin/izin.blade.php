@extends('layouts.dashboard-layout')
@section('title','izin')
@section('content')

<div class="mx-5">
    <h1 class="text-2xl font-bold mb-4">Laporan</h1>
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <span class="mr-2">Show</span>
            <select wire:model="perPage" class="border rounded px-2 py-1">
                <option>3</option>
                <option>5</option>
                <option>10</option>
            </select>
            <span class="ml-2">entries</span>
        </div>
        <div>
            <input wire:model.debounce.300ms="search" type="text" placeholder="Search..." class="border rounded px-3 py-1 w-64">
        </div>
    </div>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-left">Nomor</th>
                <th class="border p-2 text-left">Nama</th>
                <th class="border p-2 text-left">Keterangan</th>
                <th class="border p-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($izin as $item)
            <tr>
                <td class="border p-2">{{ $loop->iteration }}</td>
                <td class="border p-2">{{ $item->user->name }}</td>
                <td class="border p-2">{{ $item->keterangan }}</td>
                <td class="border p-2">
                    <a href="{{ asset('storage/'.$item->surat_izin) }}" download>Download File Izin</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{-- {{ $laporan->links() }} --}}
    </div>
</div>
@endsection