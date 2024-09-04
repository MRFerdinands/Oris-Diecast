<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-compact layout-menu-fixed">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard' }}</title>

    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/core_new.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/theme_new.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    {{-- Fonts CSS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fonts/boxicons.css') }}">
    {{-- Vendor CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/filepond/plugin/image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.css') }}">
    <script src="{{ asset('assets/js/helpers.js') }}"></script>
    {{-- Livewire --}}
    @livewireStyles
    {{-- Custom CSS --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <x-dashboards.sidebar />
            <!-- Layout container -->
            <div class="layout-page">
                <x-dashboards.navbar />
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    {{ $slot }}
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- Main JS --}}
    <script src="{{ asset('assets/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- Vendor JS --}}
    <script src="{{ asset('assets/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/libs/filepond/filepond.js') }}"></script>
    <script src="{{ asset('assets/libs/filepond/plugin/image-preview.js') }}"></script>
    <script src="{{ asset('assets/libs/filepond/plugin/file-validate.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/libs/clipboardjs/clipboardjs.js') }}"></script>
    {{-- Livewire --}}
    @livewireScripts
</body>

</html>
