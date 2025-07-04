{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Elite Rental Admin'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light-gray flex min-h-screen">
    <!-- Sidebar Admin -->
    @include('components.navigation.admin-sidebar')

    <!-- Mobile sidebar overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden hidden"></div>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header Admin -->
        @include('components.admin-header')

        <!-- Main Content Area -->
        <main class="p-6 flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    {{-- Component Pesan Kustom --}}
    <x-messages.custom-message />

    {{-- Semua script JS akan di-push ke sini --}}
    @stack('scripts')

    <script>
        // Sidebar toggle functionality (tetap di layout karena ini global untuk layout)
        const sidebarToggle = document.getElementById("sidebarToggle");
        const sidebar = document.getElementById("sidebar");
        const sidebarOverlay = document.getElementById("sidebarOverlay");

        if (sidebarToggle && sidebar && sidebarOverlay) {
            // Initial check for large screens to ensure sidebar is visible by default
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove("-translate-x-full");
                sidebar.classList.add("relative");
                sidebarOverlay.classList.add("hidden");
            } else {
                sidebar.classList.add("fixed", "h-screen", "left-0", "top-0");
                sidebar.classList.remove("relative");
            }

            sidebarToggle.addEventListener("click", () => {
                sidebar.classList.toggle("-translate-x-full");
                sidebarOverlay.classList.toggle("hidden");
            });

            sidebarOverlay.addEventListener("click", () => {
                sidebar.classList.add("-translate-x-full");
                sidebarOverlay.classList.add("hidden");
            });

            // Handle resize to adjust sidebar behavior
            window.addEventListener("resize", () => {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove("-translate-x-full", "fixed", "left-0", "top-0");
                    sidebar.classList.add("relative", "flex", "flex-col", "h-screen", "shrink-0");
                    sidebarOverlay.classList.add("hidden");
                } else {
                    sidebar.classList.remove("relative", "flex", "flex-col", "h-screen", "shrink-0");
                    sidebar.classList.add("fixed", "left-0", "top-0", "h-screen");
                    if (!sidebar.classList.contains("-translate-x-full")) {
                        sidebar.classList.add("-translate-x-full");
                    }
                }
            });
        }

        // Auto-refresh data every 30 seconds (simulation)
        setInterval(() => {
            console.log("Refreshing dashboard data...");
            // In a real application, you would fetch new data from your API
        }, 30000);

        // Animate progress bars on load
        window.addEventListener("load", function() {
            const progressBars =
                document.querySelectorAll('[style*="width:"]');
            progressBars.forEach((bar) => {
                const width = bar.style.width;
                bar.style.width = "0%";
                setTimeout(() => {
                    bar.style.transition = "width 1.5s ease-in-out";
                    bar.style.width = width;
                }, 100);
            });
        });
    </script>
</body>

</html>
