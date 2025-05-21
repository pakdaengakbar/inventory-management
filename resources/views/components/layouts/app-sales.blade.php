<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | @yield('page-title')</title>
    @include('layouts.partials/title-meta', ['title' => $title ?? 'Default Title'])

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
    @yield('css')
    @vite(['resources/scss/app.scss', 'resources/scss/icons.scss'])
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css'])
</head>
<body class="bg-primary bg-opacity-10">
     <div class="maintenance-sales">
            <div class="container-fluid mt-2">
                {{ $slot }}
            </div>
            @include('layouts.partials/footer')
        </div>
    @livewireScripts
    <script src="{{ URL::asset('build/assets/custom.js') }}"></script>
    @yield('script')
    @vite(['resources/js/app.js'])
    @vite(['resources/js/pages/datatable.init.js'])

    @yield('script-bottom')

</body>
</html>
