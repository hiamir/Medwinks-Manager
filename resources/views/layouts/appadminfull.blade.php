<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    {{--    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link href="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/modal.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}" data-turbolinks-eval="true" defer></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js"></script>
    @livewireStyles
</head>

<body>




@if(session()->has('sweet-alert'))
    <script type="text/javascript">
        Swal.fire({
            title: "{!! session('sweet-alert.title') !!}",
            html: "{!! session('sweet-alert.message') !!}",
            icon: "{!! session('sweet-alert.icon') !!}",
            allowOutsideClick: false,
            allowEscapeKey: false,
        });
    </script>
@endif
@if(session()->has('formError'))
    <script type="text/javascript">
        Swal.fire({
            title: "{!! session('formError.title') !!}",
            text: "{!! session('formError.message') !!}",
            icon: "{!! session('formError.icon') !!}",
            allowOutsideClick: false,
            allowEscapeKey: false,
        });
    </script>
@endif

@if (session('alert'))
    <script>
        @if(Session::has('alert'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true
            }
        toastr.success("{{ session('alert')['message'] }}");
        @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true
            }
        toastr.error("{{ session('error') }}");
        @endif

            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true
            }
        toastr.info("{{ session('info') }}");
        @endif

            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true
            }
        toastr.warning("{{ session('warning') }}");
        @endif
    </script>
@endif

@guest('admin')
    <div id="auth">
        {{ $slot }}
    </div>
@endguest

@auth('admin')

    @if(!isset(auth()->user()->email_verified_at))
        <div id="auth">
            {{ $slot }}
        </div>
    @else
        <div id="app">

{{--            @include('livewire.components.menu.index')--}}
             <livewire:components.adminmenu.menu />
{{--            <livewire:components.AdminMenu.Menu/>--}}
            <div id="main">
                {{$slot}}
                <livewire:components.userfooter/>
            </div>
        </div>
    @endif
@endauth
</body>

@livewireScripts

<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script>


<script>

    $(document).ready(function () {
        $(".modal").each(function () {
            $(this).css('zIndex', '1050')

        });
        $(".modal.secondModal").each(function () {
            $(this).css('zIndex', '1052')

        });

        //   $('.btn').click(function(){
        //       if
        //       $first= $(this).next('.modal');
        // $first.css('zIndex',1061);
        //
        //      console.log($first.find('.modal.second').attr('class'))
        //      // $(this).each(function(){
        //      //     console.log($(this).attr('class'));
        //       $first.find('.modal.second').css('zIndex',1063)
        //      // })
        //
        //
        $('.btn').click(function () {
            let $z = 1048;
            $('.modal-backdrop').each(function () {
                $(this).css('zIndex', $z)
                $z = $z + 2;
            })
        });
        // })
    });
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "preventDuplicates": true,
            "preventOpenDuplicates": true
        }
    });


    window.addEventListener('modalClose', event => {
        $('#' + event.detail).modal('hide');
        //
    });
    window.addEventListener('modalBackgroundClose', event => {
        $('.modal-backdrop.show').last().remove();
    });

    window.addEventListener('swal',function(e){
        // Swal.fire(e.detail);
        Swal.fire('Any fool can use a computer')
    });

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    // document.addEventListener("turbolinks:request-start", function(event) {
    //     var xhr = event.data.xhr
    //     xhr.setRequestHeader("X-Request-Id", "123...")
    // })

    // document.addEventListener('livewire:load', function (event) {
    //     window.livewire.on('redirect', param => {
    //         Turbolinks.enableTransitionCache();
    //         Turbolinks.visit(param)
    //
    //     })
    // });

</script>

@stack('scripts')

</html>
