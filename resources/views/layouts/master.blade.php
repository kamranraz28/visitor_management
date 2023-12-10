<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.css')
</head>
<body>
    <div class="main-wrapper">
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
        {{-- <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div> --}}
    </div>
    @include('layouts.js')
    @yield('js')
</body>
</html>
