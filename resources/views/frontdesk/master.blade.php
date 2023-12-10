<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.css')
</head>

<body>
    <div class="main-wrapper">
        <header class="header header-fixed header-one">
            @include('frontdesk.header')
        </header>

        <div class="container-fluid" style="padding-top:120px">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-xl-3 theiaStickySidebar">
                    @include('frontdesk.sidebar')
                </div>
                <div class="col-md-9 col-lg-9 col-xl-9">
                   
                        @yield('content')
                  
                </div>
            </div>
        </div>
    </div>

    @include('layouts.js')
    @yield('js')

    
</body>

</html>
