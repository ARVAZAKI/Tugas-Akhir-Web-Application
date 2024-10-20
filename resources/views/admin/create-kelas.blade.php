@extends('layouts.dashboard-layout')
@section('title','Buat Kelas')
@section('content')

<div class="mx-5" x-data="{ modelKelas: false }">
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
    <h1 class="text-2xl font-bold mb-4">Kelas</h1>
    
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
            <button @click="modelKelas = true" class="py-2 px-6 rounded-lg bg-blue-500 text-white hover:bg-blue-700 transition-colors whitespace-nowrap w-auto">
                Buat Kelas
            </button>
            
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2 text-left">Nomor</th>
                    <th class="border p-2 text-left">Kelas</th>
                    <th class="border p-2 text-left">Kode kelas</th>
                    <th class="border p-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Replace with dynamic content -->
                @foreach ($kelas as $item)
                <tr>
                    <td class="border p-2">{{$loop->iteration}}</td>
                    <td class="border p-2">{{$item->nama_kelas}}</td>
                    <td class="border p-2">{{ $item->kode_kelas }}</td>
                    <td class="border p-2">
                        <button class="text-red-500 hover:text-red-700 transition-colors" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M3 6h18"></path>
                                  <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                  <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                  <line x1="10" y1="11" x2="10" y2="17"></line>
                                  <line x1="14" y1="11" x2="14" y2="17"></line>
                              </svg>
                          </button>
                          
                          <form id="delete-form-{{ $item->id }}" action="{{ route('delete-kelas', $item->id) }}" method="post">
                              @csrf
                              @method('delete')
                          </form>
                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
    </div>
    <div x-show="modelKelas" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75" x-cloak>
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-2xl font-bold mb-4">Buat Kelas Baru</h2>
            <form action="{{route('create-kelas')}}" method="POST">
                  @csrf
                  <div class="mb-4">
                    <label for="nama_kelas" class="block text-gray-700">Nama kelas</label>
                    <input name="nama_kelas" type="text" id="nama_kelas" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required/>
                    @error('nama_kelas') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex justify-end space-x-2">
                    <button @click="modelKelas = false" type="button" class="py-2 px-6 rounded-lg bg-red-500 text-white hover:bg-red-700 transition-colors">Batal</button>
                    <button type="submit" class="py-2 px-6 rounded-lg bg-green-500 text-white hover:bg-green-700 transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    window.addEventListener('close-modal', event => {
        Alpine.store('modelKelas', false);
    })
</script>
@endsection
