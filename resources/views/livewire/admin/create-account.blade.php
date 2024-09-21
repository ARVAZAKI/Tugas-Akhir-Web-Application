@extends('layouts.dashboard-layout')
@section('title','Buat Akun')
@section('content')

<div class="mx-5">
    <h1 class="text-2xl font-bold mb-4">Akun</h1>
    
    <!-- Filters and Actions -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-2 md:space-y-0">
        <!-- Entries Per Page -->
        <div class="flex items-center">
            <span class="mr-2">Show</span>
            <select wire:model="perPage" class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value=""></option>
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="10">10</option>
            </select>
            <span class="ml-2">entries</span>
        </div>

        <div class="flex items-center space-x-2">
            <button class="py-2 px-6 rounded-lg bg-blue-500 text-white hover:bg-blue-700 transition-colors whitespace-nowrap w-auto">
                Buat Akun
            </button>
            
            <input wire:model.debounce.300ms="search" type="text" placeholder="Search..." class="border rounded px-3 py-1 w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2 text-left">Nomor</th>
                    <th class="border p-2 text-left">Nama</th>
                    <th class="border p-2 text-left">Email</th>
                    <th class="border p-2 text-left">Role</th>
                    <th class="border p-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Replace with dynamic content -->
                <tr>
                    <td class="border p-2">1</td>
                    <td class="border p-2">Arva</td>
                    <td class="border p-2">arva@example.com</td>
                    <td class="border p-2">Admin</td>
                    <td class="border p-2">
                        <button class="text-red-500 hover:text-red-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{-- Add pagination here --}}
    </div>
</div>

@endsection
