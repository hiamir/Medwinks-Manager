<div>
{{--    <x-admin-header pageName="Profile"></x-admin-header>--}}
    <livewire:components.admin-header :pageName='$pageName'/>
    {{--<livewire:components.adminheader :pageName='$pageName'/>--}}
    <section class="section">
        <div class="card">

            <div id="notfound">
                <div class="notfound">
                    <div class="notfound-404">
                        <div></div>
                        <h1>403</h1>
                    </div>
                    <h3 class="text-uppercase">Access Denied</h3>
                    <p>{{Session::get('error')}}</p>
                    {{--                    @if(Auth::guard('admin')->check())--}}
                    {{--                        <a href="{{route('admin.dashboard')}}">Dashboard</a>--}}
                    {{--                        <a wire:click="logout" class="menu-pointer">Logout</a>--}}
                    {{--                    @else--}}
                    {{--                        <a href="{{route('user.dashboard')}}">Dashboard</a>--}}
                    {{--                        <a href="{{route('user.dashboard')}}">Logout</a>--}}
                    {{--                    @endif--}}
                </div>
            </div>

            {{--                            <div id="notfound">--}}
            {{--                                <div class="notfound">--}}
            {{--                                    <div class="notfound-404">--}}
            {{--                                        <h1>4<span>0</span>3</h1>--}}
            {{--                                    </div>--}}
            {{--                                    <p>{{Session::get('error')}}</p>--}}
            {{--                                    @if(Auth::guard('admin')->check())--}}
            {{--                                        <a href="{{route('admin.dashboard')}}">Dashboard</a>--}}
            {{--                                        <a wire:click="logout" class="menu-pointer">Logout</a>--}}
            {{--                                    @else--}}
            {{--                                                    <a href="{{route('user.dashboard')}}">Dashboard</a>--}}
            {{--                                                    <a href="{{route('user.dashboard')}}">Logout</a>--}}
            {{--                                    @endif--}}

            {{--                                </div>--}}
            {{--                            </div>--}}


        </div>
    </section>
</div>







