<header class="header header-fixed header-one">
    <div class="container">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="" class="navbar-brand logo">
                    <img src="{{ asset('assets/img/logo.png') }}" class="" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="" class="menu-logo">
                        <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <ul class="main-nav">
                    <li class="has-submenu active">
                        <a href="{{route('home')}}">Home <i class=""></i></a>
                    </li>

                    <li class="has-submenu">
                        <a href="javascript:void(0);">Visitors <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li class="has-submenu">
                                <a href="{{route('apply')}}">Apply to visit </a>
                            </li>
                        </ul>
                    </li>

                    
                    <li class="has-submenu active">
                        <a href="{{route('login')}}">Admin Login <i class=""></i></a>
                    </li>
                        
                        
                       

                </ul>
</header>
