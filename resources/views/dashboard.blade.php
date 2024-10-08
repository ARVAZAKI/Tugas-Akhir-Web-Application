@extends('layouts.dashboard-layout')
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
                <th class="border p-2 text-left">Nama Pelapor</th>
                <th class="border p-2 text-left">Tanggal</th>
                <th class="border p-2 text-left">Laporan</th>
                <th class="border p-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($laporan as $item)
            <tr>
                <td class="border p-2">{{ $loop->iteration }}</td>
                <td class="border p-2">{{ $item->nama_pelapor }}</td>
                <td class="border p-2">{{ $item->tanggal->format('d-m-Y') }}</td>
                <td class="border p-2">{{ $item->laporan }}</td>
                <td class="border p-2">
                    <button wire:click="delete({{ $item->id }})" class="text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </button>
                </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
    <div class="mt-4">
        {{-- {{ $laporan->links() }} --}}
    </div>
</div>
@endsection