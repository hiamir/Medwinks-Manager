<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="{{asset('images/logo-circle.svg')}}" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }} menu-pointer">
                    <a
                        {{--                        wire:click=$emit("display",{{ json_encode(['dashboard'=>'Dashboard']) }})--}}
                        href="{{route('admin.dashboard')}}"
                        class='sidebar-link menu-pointer'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub
                @if(
                    request()->routeIs('admin.admins*') ||
                    request()->routeIs('admin.users*') ||
                    request()->routeIs('admin.roles*') ||
                    request()->routeIs('admin.permissions*')
                   )
                    active
                @else ''
                @endif
                    menu-pointer">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Security</span>
                    </a>
                    <ul class="submenu
                    @if(
                        request()->routeIs('admin.admins*') ||
                        request()->routeIs('admin.users*') ||
                        request()->routeIs('admin.roles*') ||
                        request()->routeIs('admin.permissions*')
                        )
                        d-block
                        @else 'none'
                    @endif
                        ">

                        @hasrole('Super Admin')

                        <li class="submenu-item {{ request()->routeIs('admin.admins*') ? 'active' : '' }} menu-pointer">
                            <a class="menu-pointer"
                               href="{{route('admin.admins')}}"
                            >Admins</a>
                        </li>

                        @endhasrole

                        @hasrole('Super Admin|Admin')
                        @can('view-users')
                            <li class="submenu-item {{ request()->routeIs('admin.users*') ? 'active' : '' }} menu-pointer">
                                <a class="menu-pointer"
                                   href="{{route('admin.users')}}"
                                >Users</a>
                            </li>
                        @endcan
                        {{-- Super Admin Permission --}}

                        @can('view-roles')
                            <li class="submenu-item {{ request()->routeIs('admin.roles*') ? 'active' : '' }} menu-pointer">
                                <a class="menu-pointer"
                                   href="{{route('admin.roles')}}"
                                >Roles</a>
                            </li>
                        @endcan


                        {{--                       PERMISSION LINK                  --}}
                        {{--                        Check Has Role Admin and View Permission                --}}
                        @hasrole('Admin')
                        @can('view-permissions')
                            <li class="submenu-item {{ request()->routeIs('admin.permissions*') ? 'active' : '' }} menu-pointer">
                                <a class="menu-pointer"
                                   href="{{route('admin.permissions')}}"
                                >Permissions</a>
                            </li>
                        @endcan
                        @endhasrole

                        {{--                        Check Has Role Super Admin and Allow Permission --}}
                        @hasrole('Super Admin')
                        <li class="submenu-item {{ request()->routeIs('admin.permissions*') ? 'active' : '' }} menu-pointer">
                            <a class="menu-pointer"
                               href="{{route('admin.permissions')}}"
                            >Permissions</a>
                        </li>
                        @endhasrole
                        {{--                        End has Role                --}}


                        @endhasrole


                        {{-- End Super Admin Permssion --}}
                    </ul>
                </li>

                {{--                `DATA  MENU STARTS          --}}
                @hasrole('Super Admin|Admin')
                <li class="sidebar-item has-sub
                @if(
                    request()->routeIs('admin.countries*')
                   )
                    active
                @else ''
                @endif
                    menu-pointer">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Data</span>
                    </a>
                    <ul class="submenu
                    @if(
                        request()->routeIs('admin.countries*')
                        )
                        d-block
                        @else 'none'
                    @endif
                        ">

                        @can('view-countries')

                            <li class="submenu-item {{ request()->routeIs('admin.countries*') ? 'active' : '' }} menu-pointer">
                                <a class="menu-pointer"
                                   href="{{route('admin.countries')}}"
                                >Countries</a>
                            </li>
                        @endcan
                        @endhasrole


                    </ul>
                </li>


                <li class="sidebar-item  ">
                    <a href="form-layout.html" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Form Layout</span>
                    </a>
                </li>


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>


{{--@livewire('components.adminheader', ['title' => 'Dashboard', 'breadcrumbs'=>['Dashboard'=>'admin.dashboard']])--}}
