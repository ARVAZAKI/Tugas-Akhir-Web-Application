@extends('layouts.dashboard-layout')
@section('title','Buat Mapel')
@section('content')

<div class="mx-5" x-data="{ modelmapel: false, mapelkelas: false, addkelasmapel: false }">
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md shadow-md transition-all duration-500 ease-in-out transform hover:scale-105">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif
    <!-- Header and Action Buttons -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-4">Mata Pelajaran</h1>
        
        <!-- Filters and Actions -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-2 md:space-y-0">
            <!-- Entries Per Page -->
            <div class="flex items-center">
                <span class="mr-2">Show</span>
                <select class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                </select>
                <span class="ml-2">entries</span>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-2">
                {{-- <button @click="addkelasmapel = true" class="py-2 px-6 rounded-lg bg-yellow-400 text-white hover:bg-yellow-700 transition-colors whitespace-nowrap">
                    Tambahkan kelas mapel
                </button> --}}
                <button @click="modelmapel = true" class="py-2 px-6 rounded-lg bg-blue-500 text-white hover:bg-blue-700 transition-colors whitespace-nowrap">
                    Buat mapel
                </button>
            </div>
        </div>
    </div>

    <!-- Table section -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2 text-left">Nomor</th>
                    <th class="border p-2 text-left">Mapel</th>
                    <th class="border p-2 text-left">Daftar Guru</th>
                    <th class="border p-2 text-left">Daftar Kelas</th>
                    <th class="border p-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mapel as $item)
                <tr>
                    <td class="border p-2">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $item->nama_mapel }}</td>
                    <td class="border p-2">
                        @if($item->guru->isNotEmpty())
                            <ul>
                                @foreach($item->guru as $guru)
                                    <li>- {{ $guru->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span>Belum ada guru</span>
                        @endif
                    </td>
                    <td class="border p-2">
                        @if($item->kelas->isNotEmpty())
                            <ul>
                                @foreach($item->kelas as $kelas)
                                    <li>- {{ $kelas->nama_kelas }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span>Belum ada kelas</span>
                        @endif
                    </td>
                    <td class="border p-2">
                        <div class="flex space-x-2">
                            <form action="{{ route('delete-mapel', $item->id) }}" method="post" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </button>
                            </form>
                            <button @click="mapelkelas = true" class="text-blue-500 hover:text-blue-700 transition-colors">
                                <img src="{{asset('assets/setting.svg')}}" alt="Settings">
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Buat Mapel -->
    <div x-show="modelmapel" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75" x-cloak>
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-2xl font-bold mb-4">Buat Mapel Baru</h2>
            <form action="{{ route('create-mapel') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_mapel" class="block text-gray-700">Nama mapel</label>
                    <input name="nama_mapel" type="text" id="nama_mapel" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required/>
                    @error('nama_mapel') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" @click="modelmapel = false" class="py-2 px-6 rounded-lg bg-red-500 text-white hover:bg-red-700 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="py-2 px-6 rounded-lg bg-green-500 text-white hover:bg-green-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Kelas Mapel -->
    {{-- <div x-show="addkelasmapel" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75" x-cloak>
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-2xl font-bold mb-4">Tambahkan Guru ke Mapel</h2>
            <form action="{{ route('create-KM') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="mapel_id" class="block text-sm font-medium text-gray-700">Pilih mata pelajaran</label>
                        <select name="mapel_id" id="mapel_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Pilih Mata pelajaran</option>
                            @foreach ($mapel as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih Guru</label>
                        <select name="user_id" id="user_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Pilih Guru</option>
                            @foreach ($guru as $g)
                                <option value="{{ $g->id }}">{{ $g->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" @click="addkelasmapel = false" class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Batal
                    </button>
                    <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div> --}}
</div>

<script>
    window.addEventListener('close-modal', event => {
        Alpine.store('modelmapel', false);
    })
    window.addEventListener('close-modal', event => {
        Alpine.store('mapelkelas', false);
    })
</script>

@endsection