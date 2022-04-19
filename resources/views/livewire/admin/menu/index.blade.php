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

                @foreach($menuCategories as $category)

                    {{--                {{dd(Spatie\Permission\Models\Role::findByName('Admin')->permissions)}}--}}
                    {{--                {{(dd(count($category->links)))}}--}}
                    @if(count($category->links) > 0)
                        @if(($category->links->pluck('folder')->first()->name) === 'Root')
                            @foreach($category->links as $link)
                                @if(\Illuminate\Support\Facades\Route::has($link->route))
                                    <li class="sidebar-item  {{ request()->routeIs($link->route.'*') ? 'active' : '' }} menu-pointer">
                                        <a
                                            href="{{route($link->route)}}"
                                            class='sidebar-link menu-pointer'>
                                            <i class="bi bi-grid-fill"></i>
                                            <span>{{$link->name}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @else
                            @if(count($category->links)>0)
                                <li class="sidebar-item has-sub

                                 @foreach($category->links as $link)
                                {{ request()->routeIs($link->route.'*') ? 'active' : '' }}
                                @endforeach
                                    menu-pointer">
                                    <a href="#" class='sidebar-link'>
                                        <i class="bi bi-grid-1x2-fill"></i>
                                        <span>{{$category->name}}</span>
                                    </a>
                                    <ul class="submenu
                                                                 @foreach($category->links as $link)

                                    @if(($routeLink == $link->route)) active @endif
                                    {{   request()->routeIs($link->route.'*') ? 'active d-block' : 'none'    }}
                                    @endforeach
                                        ">
                                        @foreach($category->links as $link)


                                            @if(isset($routeLink))
                                                <li class="submenu-item
                                                @if(($routeLink == $link->route)) active @endif
                                                    menu-pointer">
                                                    <button wire:click="getRoute('{{$link->route}}')"
                                                            class="menu-pointer"
                                                            href="{{route($link->route)}}"
                                                    >{{$link->name}}
                                                    </button>
                                                </li>

                                            @elseif(\Illuminate\Support\Facades\Route::has($link->route))

                                                <li class="submenu-item
                                                {{ request()->routeIs($link->route.'*') ? 'active' : '' }}
                                                    menu-pointer">
                                                    <button wire:click="getRoute('{{$link->route}}')"
                                                            class="menu-pointer"
                                                            href="{{route($link->route)}}"
                                                    >{{$link->name}}
                                                    </button>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        <button class=" sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>


{{--@livewire('components.adminheader', ['title' => 'Dashboard', 'breadcrumbs'=>['Dashboard'=>'admin.dashboard']])--}}
