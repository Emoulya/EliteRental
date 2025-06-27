{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Elite Rental Admin') }}</title>

    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light-gray flex min-h-screen"> {{-- Menggunakan min-h-screen agar body mengisi penuh tinggi, dan flex untuk layout sidebar --}}

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

    <script>
        // Sidebar toggle functionality
        const sidebarToggle = document.getElementById("sidebarToggle");
        const sidebar = document.getElementById("sidebar");
        const sidebarOverlay = document.getElementById("sidebarOverlay");

        if (sidebarToggle && sidebar && sidebarOverlay) {
            sidebarToggle.addEventListener("click", () => {
                sidebar.classList.toggle("-translate-x-full");
                sidebarOverlay.classList.toggle("hidden");
            });

            sidebarOverlay.addEventListener("click", () => {
                sidebar.classList.add("-translate-x-full");
                sidebarOverlay.classList.add("hidden");
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
            updateDonutChart(); // Call function to update donut chart on load
        });

        // Function to update the donut chart slices based on data
        function updateDonutChart() {
            const total = 24;
            const available = 18;
            const rented = 4;
            const maintenance = 2;

            // These percentages are used for the width of the progress bars, not the donut chart slices
            const availablePercentage = (available / total) * 100;
            const rentedPercentage = (rented / total) * 100;
            const maintenancePercentage = (maintenance / total) * 100;

            // The donut chart simulation using clip-path in the original HTML is a visual trick
            // For a true, accurate donut chart, you would typically use an SVG or a charting library
            // like Chart.js. The current implementation's clip-path styles are hardcoded and approximate.
            // I'm leaving the existing CSS styles for the donut slices as they were provided,
            // as dynamically adjusting complex clip-paths via JS is more involved and usually
            // handled by dedicated charting libraries.
        }
    </script>
</body>

</html>
