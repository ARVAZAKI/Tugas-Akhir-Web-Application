    @extends('layouts.dashboard-layout')
    @section('title','Buat Mapel')
    @section('content')

    <div class="mx-5" x-data="{ modelmapel: false }">
    <div class="mx-5" x-data="{ mapelkelas: false }">
    <div class="mx-5" x-data="{ addkelasmapel: false }">
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
    @if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md shadow-md transition-all duration-500 ease-in-out transform hover:scale-105">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L7.586 10l-1.293 1.293a1 1 0 101.414 1.414l2-2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
        <h1 class="text-2xl font-bold mb-4">Mata Pelajaran</h1>
        
        <!-- Filters and Actions -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-2 md:space-y-0">
            <!-- Entries Per Page -->
            <div class="flex items-center">
                <span class="mr-2">Show</span>
                <select class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value=""></option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                </select>
                <span class="ml-2">entries</span>
            </div>

            <div class="flex items-center space-x-2">
                <button @click="addkelasmapel = true" class="py-2 px-6 rounded-lg bg-yellow-400 text-white hover:bg-yellow-700 transition-colors whitespace-nowrap w-auto">
                    Tambahkan kelas mapel
                </button>
                <button @click="modelmapel = true" class="py-2 px-6 rounded-lg bg-blue-500 text-white hover:bg-blue-700 transition-colors whitespace-nowrap w-auto">
                    Buat mapel
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">Nomor</th>
                        <th class="border p-2 text-left">Mapel</th>
                        <th class="border p-2 text-left">Daftar kelas</th>
                        <th class="border p-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Replace with dynamic content -->
                    @foreach ($mapel as $item)
                    <tr>
                        <td class="border p-2">{{ $loop->iteration }}</td>
                        <td class="border p-2">{{ $item->nama_mapel }}</td>
                        <td class="border p-2">
                            @if($item->kelas->isNotEmpty())
                                <ul>
                                    @foreach($item->kelas as $kelas)
                                        <li>- {{ $kelas->nama_kelas }}</li>
                                    @endforeach
                                </ul>
                                <div x-show="mapelkelas" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75" x-cloak>
                                    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
                                        <h2 class="text-2xl font-bold mb-4">Pengaturan Kelas</h2>
                                        <table class="w-full border-collapse table-auto bg-white shadow-lg rounded-lg">
                                            <thead class="bg-gray-200">
                                                <tr class="text-left text-gray-600">
                                                    <th class="py-3 px-4 font-semibold text-sm">Kelas</th>
                                                    <th class="py-3 px-4 font-semibold text-sm">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="border-t border-gray-300 hover:bg-gray-100">
                                                    <td class="py-2 px-4 text-gray-800">{{ $kelas->nama_kelas }}</td>
                                                    <td class="py-2 px-4 text-gray-800">
                                                        <button class="text-red-500 hover:text-red-700 transition-colors" onclick="event.preventDefault(); document.getElementById('delete-kelas-{{ $kelas->id }}').submit();">
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
                                        
                                        <div class="flex justify-end space-x-2">
                                            <button @click="mapelkelas = false" type="button" class="py-2 px-6 rounded-lg bg-red-500 text-white hover:bg-red-700 transition-colors">Batal</button>
                                        </div>
                                    </div>
                                </div>
                                <form id="delete-kelas-{{ $kelas->id }}" action="{{ route('delete-mapel-kelas', $kelas->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                            @else
                                Belum ada kelas
                            @endif
                        </td>
                        <td class="border p-2 flex">
                            <button class="text-red-500 hover:text-red-700 transition-colors" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                            <button @click="mapelkelas = true" class="text-red-500 hover:text-red-700 transition-colors">
                                <img src="{{asset('assets/setting.svg')}}" alt="">
                            </button>
                            
                            
                            <form id="delete-form-{{ $item->id }}" action="{{ route('delete-mapel', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
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
                        <button @click="modelmapel = false" type="button" class="py-2 px-6 rounded-lg bg-red-500 text-white hover:bg-red-700 transition-colors">Batal</button>
                        <button type="submit" class="py-2 px-6 rounded-lg bg-green-500 text-white hover:bg-green-700 transition-colors">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div x-show="addkelasmapel" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75" x-cloak>
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
                <h2 class="text-2xl font-bold mb-4">Tambahkan Mapel ke Kelas</h2>
                
                <!-- Buat div container untuk membuat layout vertikal -->
                <div class="flex flex-col space-y-4">
                    <form action="{{ route('create-KM') }}" method="POST">
                        @csrf
                        <div>
                            <label for="mapel_id" class="block text-sm font-medium text-gray-700">Pilih mata pelajaran</label>
                            <select name="mapel_id" id="mapel_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Pilih Mata pelajaran</option>
                                @foreach ($mapel as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="kelas_id" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Pilih Kelas</option>
                                {{-- @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih Guru</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Pilih Guru</option>
                                @foreach ($guru as $g)
                                <option value="{{ $g->id }}">{{ $g->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="mt-3 py-2 px-6 rounded-lg bg-green-500 text-white hover:bg-green-700 transition-colors">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        
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
