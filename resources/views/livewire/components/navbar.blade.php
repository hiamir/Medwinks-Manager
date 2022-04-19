<div>
    {{--    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
    {{--        <div class="container-fluid">--}}
    {{--            <a class="navbar-brand" href="{{ url('/') }}">--}}
    {{--                {{ config('app.name', 'Laravel') }}--}}
    {{--            </a>--}}
    {{--            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"--}}
    {{--                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"--}}
    {{--                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
    {{--                <span class="navbar-toggler-icon"></span>--}}
    {{--            </button>--}}

    {{--            <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
    {{--                <!-- Left Side Of Navbar -->--}}
    {{--                <ul class="navbar-nav me-auto">--}}
    {{--                </ul>--}}

    {{--                <!-- Right Side Of Navbar -->--}}
    {{--                <ul class="navbar-nav ms-auto">--}}
    {{--                    <!-- Authentication links -->--}}
    {{--                    @guest--}}
    {{--                        @if (Route::has('login'))--}}
    {{--                            <li class="nav-item">--}}
    {{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}

    {{--                        @if (Route::has('register'))--}}
    {{--                            <li class="nav-item">--}}
    {{--                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}
    {{--                    @else--}}
    {{--                        <li class="nav-item dropdown">--}}
    {{--                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"--}}
    {{--                               data-bs-toggle="dropdown" aria-expanded="false">--}}
    {{--                                {{ Auth::user()->name }}--}}
    {{--                            </a>--}}

    {{--                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
    {{--                                <li>--}}
    {{--                                   <livewire:logout />--}}
    {{--                                </li>--}}


    {{--                            </ul>--}}
    {{--                        </li>--}}
    {{--                    @endguest--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </nav>--}}


    {{--    <nav class="navbar navbar-expand-lg main-navbar">--}}
    {{--        <div class="container">--}}
    {{--            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">--}}
    {{--                <span class="navbar-toggler-icon"></span>--}}
    {{--            </button>--}}
    {{--            <div class="collapse navbar-collapse justify-content-center" id="navbarTogglerDemo02">--}}
    {{--                <ul class="navbar-nav me-auto mb-2 mb-lg-0">--}}
    {{--                    <li class="menu-item  ">--}}
    {{--                        <a href="{{route('dashboard')}}" class='menu-link'>--}}
    {{--                            <i class="bi bi-grid-fill"></i>--}}
    {{--                            <span>Dashboard</span>--}}
    {{--                        </a>--}}
    {{--                    </li>--}}
    {{--                    <li class="menu-item  has-sub">--}}
    {{--                        <a href="#" class='menu-link'>--}}
    {{--                            <i class="bi bi-table"></i>--}}
    {{--                            <span>Table</span>--}}
    {{--                        </a>--}}
    {{--                        <div class="submenu ">--}}
    {{--                            <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->--}}
    {{--                            <div class="submenu-group-wrapper">--}}


    {{--                                <ul class="submenu-group">--}}

    {{--                                    <li class="submenu-item  ">--}}
    {{--                                        <a href="table.html" class='submenu-link'>Table</a>--}}


    {{--                                    </li>--}}



    {{--                                    <li class="submenu-item  ">--}}
    {{--                                        <a href="table-datatable.html" class='submenu-link'>Datatable</a>--}}


    {{--                                    </li>--}}


    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--                <form class="d-flex">--}}
    {{--                    <livewire:logout />--}}

    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </nav>--}}

    <nav class="main-navbar">
        <div class="container d-xl-flex align-items-center  flex-end ">

            <ul class="d-block d-xl-flex">
                <li class="menu-item  ">
                    <a href="{{route('dashboard')}}" class='menu-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-table"></i>
                        <span>Table</span>
                    </a>
                    <div class="submenu ">
                        <div class="submenu-group-wrapper">

                            <ul class="submenu-group">
                                <li class="submenu-item  ">
                                    <a href="table.html" class='submenu-link'>Table</a>
                                </li>
                                <li class="submenu-item  ">
                                    <a href="table-datatable.html" class='submenu-link'>Datatable</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="d-block d-xl-flex  ms-auto">
                <li class="menu-item ">
                <livewire:logout />
                </li>
            </ul>
        </div>
    </nav>

</div>


