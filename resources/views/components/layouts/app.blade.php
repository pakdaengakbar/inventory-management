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

<body data-menu-color="light" data-sidebar="default">
    <div id="app-layout">
        @include('layouts.partials/topbar')
        @include('layouts.partials/sidebar')

        <div class="content-page">
            <div class="content">
                {{ $slot }}
            </div>
            @include('layouts.partials/footer')
        </div>
    </div>
    @livewireScripts

    @yield('script')
    @vite(['resources/js/app.js'])
    @vite(['resources/js/pages/datatable.init.js'])

    @yield('script-bottom')

</body>
</html>
