<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials/title-meta', ['title' => $title])

    @include('layouts.partials/head-css')
</head>

<body data-menu-color="light" data-sidebar="default">

    <div id="app-layout">

        @include('layouts.partials/topbar')
        @include('layouts.partials/sidebar')
        <div class="content-page">
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.partials/footer')
        </div>
    </div>
    @include('layouts.partials/vendor')
    <script src="{{ URL::asset('build/assets/custom.js') }}"></script>
    <script>
        document.getElementById('daygreating').textContent = checkTimeOfDay();
    </script>
</body>

</html>
