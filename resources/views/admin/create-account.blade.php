@extends('layouts.dashboard-layout')
@section('title', 'Buat Akun')
@section('content')

<div class="mx-5" x-data="{ showModal: false }">
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
    <h1 class="text-2xl font-bold mb-4">Akun</h1>
    
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

        <div class="flex items-center space-x-2">
            <button @click="showModal = true" class="py-2 px-6 rounded-lg bg-blue-500 text-white hover:bg-blue-700 transition-colors">
                Buat Akun
            </button>
            
            <input type="text" id="search" placeholder="Search..." class="border rounded px-3 py-1 w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500" />        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="table-account" class="w-full border-collapse table-auto">
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
                  @foreach($users as $index => $user)
                  <tr>
                      <td class="border p-2">{{ $index + 1 }}</td>
                      <td class="border p-2">{{ $user->name }}</td>
                      <td class="border p-2">{{ $user->email }}</td>
                      <td class="border p-2">{{ ucfirst($user->role) }}</td>
                      <td class="border p-2">
                          <button class="text-red-500 hover:text-red-700 transition-colors" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M3 6h18"></path>
                                  <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                  <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                  <line x1="10" y1="11" x2="10" y2="17"></line>
                                  <line x1="14" y1="11" x2="14" y2="17"></line>
                              </svg>
                          </button>
                          
                          <form id="delete-form-{{ $user->id }}" action="{{ route('delete-account', $user->id) }}" method="post">
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
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75" x-cloak>
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-2xl font-bold mb-4">Buat Akun Baru</h2>
            <form action="{{route('store-account')}}" method="POST">
                  @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama</label>
                    <input name="nama" type="text" id="name" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required/>
                    @error('nama') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input name="email" type="email" id="email" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required/>
                    @error('email') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Role</label>
                    <select name="role" id="role" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih role</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="teacher">Guru</option>
                    </select>
                    @error('role') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input name="password" type="password" id="password" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required/>
                    @error('password') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-gray-700">Confirm Password</label>
                    <input name="confirm_password" type="password" id="confirm_password" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required/>
                    @error('confirm_password') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex justify-end space-x-2">
                    <button @click="showModal = false" type="button" class="py-2 px-6 rounded-lg bg-red-500 text-white hover:bg-red-700 transition-colors">Batal</button>
                    <button type="submit" class="py-2 px-6 rounded-lg bg-green-500 text-white hover:bg-green-700 transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('close-modal', event => {
        Alpine.store('showModal', false);
    })
</script>
@endpush

@endsection