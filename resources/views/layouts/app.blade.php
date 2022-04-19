<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    @stack('styles')

    <!-- Scripts -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    {{--    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">--}}
{{--    <link href="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">--}}

    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.css">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link type="text/css" rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">


    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-rename/dist/filepond-plugin-file-rename.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>



{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous"></script>--}}

    <script defer src="https://unpkg.com/alpinejs@3.8.1/dist/cdn.min.js"></script>

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

@guest()
    <div id="auth">
        {{ $slot }}
    </div>
@endguest

@auth()
    @if(!isset(auth()->user()->email_verified_at))
        <div id="auth">
            {{ $slot }}
        </div>
    @else
        <div id="app">

            {{--            @include('livewire.components.menu.index')--}}

            {{--            <livewire:components.AdminMenu.Menu/>--}}
            <div id="main">

                {{$slot}}

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


    window.livewire.onError(statusCode => {
        if (statusCode === 403) {
            alert('Your own message')

            return false
        }
    })


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


    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('component.initialized', (component) => {})
        Livewire.hook('element.initialized', (el, component) => {})
        Livewire.hook('element.updating', (fromEl, toEl, component) => {})
        Livewire.hook('element.updated', (el, component) => {

        })
        Livewire.hook('element.removed', (el, component) => {})
        Livewire.hook('message.sent', (message, component) => {})
        Livewire.hook('message.failed', (message, component) => {})
        Livewire.hook('message.received', (message, component) => {})
        Livewire.hook('message.processed', (message, component) => {})
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

    $("document").ready(function(){
        setTimeout(function(){
            $("div.alert-message").fadeOut();
        }, 5000 ); // 5 secs

    });

</script>

@stack('scripts')

</html>
