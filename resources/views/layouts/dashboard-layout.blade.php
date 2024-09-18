<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSecure | @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex">
        <!-- Sidebar - hidden on small screens, visible on md and larger -->
        <div id="sidebar" class="hidden md:block w-56 min-h-screen space-y-8 bg-[#f2f4fa]">
            <div class="flex items-center justify-center py-3 text-2xl">
                <div>Logo</div>
            </div>
            <div class="px-4 space-y-3">
                <div class="flex items-center space-x-3">
                    <div><img src="{{asset('assets/Vector.svg')}}" alt="Vector" class="w-4 h-4"></div>
                    <div>Dashboard</div>
                </div>
                <div class="flex items-center space-x-2">
                    <div><img src="{{asset('assets/mdi_account-circle-outline.svg')}}" alt="Profile" class="w-5 h-5"></div>
                    <div>Profile</div>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <div class="flex items-center justify-between p-5 border-b-2 md:justify-end">
                <!-- Menu icon - visible only on small screens -->
                <div id="menu-icon" class="block md:hidden"><img src="{{asset('assets/menu.svg')}}" alt="Vector" class="w-4 h-4"></div>

                <!-- Profile section - hidden on small screens -->
                <div class="items-center hidden gap-3 md:flex">
                    <div class="rounded-full size-10 bg-slate-500"></div>
                    <div class="text-right">
                        <div class="text-lg">Nama</div>
                        <div class="text-xs">Student</div>
                    </div>
                </div>
            </div>
            <div>@yield('content')</div>
        </div>
    </div>

    <script>
        const menuIcon = document.getElementById('menu-icon');
        const sidebar = document.getElementById('sidebar');
        let sidebarVisible = false;

        // Toggle sidebar visibility
        menuIcon.addEventListener('click', (event) => {
            sidebar.classList.toggle('hidden');
            sidebarVisible = !sidebarVisible;
            menuIcon.classList.toggle('hidden', sidebarVisible); // Hide menu icon when sidebar is visible
            event.stopPropagation(); // Prevent the click event from propagating to document
        });

        // Close sidebar when clicking outside of it
        document.addEventListener('click', (event) => {
            if (sidebarVisible && !sidebar.contains(event.target) && !menuIcon.contains(event.target)) {
                sidebar.classList.add('hidden');
                sidebarVisible = false;
                menuIcon.classList.remove('hidden'); // Show menu icon when sidebar is hidden
            }
        });
    </script>
</body>

</html>