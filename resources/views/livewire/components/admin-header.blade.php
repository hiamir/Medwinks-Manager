<div>
    <header class="burger mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading mb-md-0">
        <div class="page-title">
            <div class="row">

                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="m-0">{{$pageName}}</h3>

                </div>
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" wire:click="view('dashboard')" aria-current="page">Main</li>
                        <li class="breadcrumb-item " wire:click="view('user')">{{$pageName}}</li>
                    </ol>
                </nav>

                <div class="profile-icon col-12 col-md-6 order-md-2 order-first">
                    <div class="dropdown float-end float-lg-end top ">
                        <a class="dropdown-toggle" href='' id="dropdownMenuButtonSec" data-bs-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="true">
                            <div class="avatar avatar-xl me-0 ">
                                <img src="https://picsum.photos/200/300?random=1" alt="" srcset="">
                                <div class="avatar-name text-sm "></div>
                            </div>
                        </a>


                        <div class="dropdown-menu bg-light-secondary shadow-sm " aria-labelledby="dropdownMenuButtonSec"
                             style="position: absolute; left: 0px; top: 0px; margin: 0px; right: auto; bottom: auto; transform: translate3d(-147px, 65px, 0px)!important;"
                             data-popper-placement="top-start">
                            <h4 class="dropdown-header p-0">{{auth()->user()->name}}</h4>
                            <span
                                class="text-sm d-inline text-white-50">{{implode(', ',json_decode(auth()->user()->roles->pluck('name')))}}</span>
                            <div class="dropdown-divider"></div>
                            @if(auth()->guard('admin')->check())
                                <a href="{{route('admin.profile')}}" class="dropdown-item d-flex align-items-center">
                            @else
                                        <a href="{{route('user.profile')}}" class="dropdown-item d-flex align-items-center">
                            @endif


                                <i class="bi bi-person-circle d-flex"></i>
                                <span class="d-flex ms-2">Profile</span>
                            </a>

                            <div class="dropdown-divider-light"></div>
                                    @if(Auth::guard('admin')->check())
                            <livewire:admin.logout/>
                            @else
                                            <livewire:logout/>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
