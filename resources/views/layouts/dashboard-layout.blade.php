<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSecure | @yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="hidden md:flex md:flex-col w-56 min-h-screen space-y-8 bg-[#f2f4fa] shadow-lg transition-transform duration-300 ease-in-out">
            <div class="flex items-center justify-center py-6 text-3xl font-bold text-blue-600">
                <div>EduSecure</div>
            </div>
            <div class="px-4 space-y-3">
                @if (Auth::user()->role == 'admin')
                <a href="{{route('admin.laporan')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Laporan" class="w-4 h-4"></div>
                    <div>Laporan</div>
                </a>

                <!-- Dropdown for Buat -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors w-full">
                        <div><img src="{{asset('assets/Vector.svg')}}" alt="Buat" class="w-4 h-4"></div>
                        <div>Buat</div>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-auto transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" class="pl-6 space-y-2">
                        <a href="{{ route('create-account') }}" wire:navigate class="block p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                            Akun Staf/Guru
                        </a>
                        <a href="{{ route('create-kelas') }}" wire:navigate class="block p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                            Kelas
                        </a>
                        <a href="{{ route('create-mapel') }}" wire:navigate class="block p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                            Mata Pelajaran
                        </a>
                    </div>
                </div>

                <a href="{{route('izin.admin')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Izin" class="w-4 h-4"></div>
                    <div>Izin</div>
                </a>
                {{-- <a href="" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Izin" class="w-4 h-4"></div>
                    <div>Absensi</div>
                </a> --}}
                <a href="{{route('profile')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/mdi_account-circle-outline.svg')}}" alt="Profile" class="w-5 h-5"></div>
                    <div>Profile</div>
                </a>
                <hr>
                @livewire('button-logout')

                @endif

                @if (Auth::user()->role == 'student')
                <a href="{{route('absen-sekolah')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                    <div>Absen Sekolah</div>
                </a>
                <a href="{{route('list.mapel')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                    <div>Absen Mapel</div>
                </a>
                <a href="{{route('izin')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                    <div>Izin</div>
                </a>
                <a href="{{route('laporan')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                <div>Laporan</div>
                </a>
                <a href="{{route('profile')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/mdi_account-circle-outline.svg')}}" alt="Profile" class="w-5 h-5"></div>
                    <div>Profile</div>
                </a>
                <hr>
                @livewire('button-logout')

                @endif
                @if (Auth::user()->role == 'teacher')
                <a href="{{route('dashboard.guru')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                    <div>Absen Mapel</div>
                </a>
                <a href="{{route('absen-sekolah')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                    <div>Absen Sekolah</div>
                </a>
                {{-- <a href="" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                    <div>Penilaian</div>
                </a> --}}
                <a href="{{route('izin')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                    <div>Izin</div>
                </a>
                <a href="{{route('laporan')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                <div>Laporan</div>
                </a>
                <a href="{{route('profile')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/mdi_account-circle-outline.svg')}}" alt="Profile" class="w-5 h-5"></div>
                    <div>Profile</div>
                </a>
                <hr>
                @livewire('button-logout')

                @endif
                @if (Auth::user()->role == 'staff')
                <a href="{{route('absen-sekolah')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                    <div>Absen Sekolah</div>
                </a>
                <a href="{{route('izin')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                    <div>Izin</div>
                </a>
                <a href="{{route('laporan')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Dashboard" class="w-4 h-4"></div>
                <div>Laporan</div>
                </a>
                <a href="{{route('profile')}}" wire:navigate class="flex items-center space-x-2 p-2 rounded-lg hover:bg-blue-500 hover:text-white transition-colors">
                    <div><img src="{{asset('assets/mdi_account-circle-outline.svg')}}" alt="Profile" class="w-5 h-5"></div>
                    <div>Profile</div>
                </a>
                <hr>
                @livewire('button-logout')

                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <div class="flex items-center justify-between p-5 border-b-2 bg-white shadow-md">
                <!-- Menu icon for small screens -->
                <div id="menu-icon" class="block md:hidden">
                    <img src="{{asset('assets/menu.svg')}}" alt="Menu" class="w-6 h-6 cursor-pointer">
                </div>
        
                <!-- Empty div to keep space between menu-icon and profile section -->
                <div class="flex-1"></div>
        
                <!-- Profile section -->
                <div class="hidden md:flex items-center gap-3">
                    <img src="{{asset('assets/profile.png')}}" class="rounded-full w-10 h-10 shadow-md" alt="profile photo">
                    <div class="text-right">
                        <div class="text-lg font-semibold">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->role }}</div>
                    </div>
                </div>
            </div>
        
            <!-- Content Section -->
            <div class="p-5">
                @yield('content')
            </div>
        </div>
        
    </div>

    <script>
        const menuIcon = document.getElementById('menu-icon');
        const sidebar = document.getElementById('sidebar');
        let sidebarVisible = false;

        menuIcon.addEventListener('click', (event) => {
            sidebar.classList.toggle('hidden');
            sidebarVisible = !sidebarVisible;
            event.stopPropagation();
        });

        document.addEventListener('click', (event) => {
            if (sidebarVisible && !sidebar.contains(event.target) && !menuIcon.contains(event.target)) {
                sidebar.classList.add('hidden');
                sidebarVisible = false;
            }
        });
    </script>
</body>

</html>
