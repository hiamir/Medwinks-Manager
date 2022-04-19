<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OMJ Manager') }}</title>

    <!-- Scripts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/8d164eb66a.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}" data-turbolinks-eval="true" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js"></script>

    @livewireStyles


</head>

<body>
@if(session()->has('componentAlert'))
    <script type="text/javascript">
        Swal.fire({
            title: "{!! session('componentAlert.title') !!}",
            text: "{!! session('componentAlert.message') !!}",
            icon: "{!! session('componentAlert.icon') !!}",
            allowOutsideClick:false,
            allowEscapeKey:false,
        });
    </script>
@endif
@if(session()->has('formError'))
    <script type="text/javascript">
        Swal.fire({
            title: "{!! session('formError.title') !!}",
            text: "{!! session('formError.message') !!}",
            icon: "{!! session('formError.icon') !!}",
            allowOutsideClick:false,
            allowEscapeKey:false,
        });
    </script>
@endif

@if (session('alert'))
    <script>
        @if(Session::has('alert'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.success("{{ session('alert')['message'] }}");
        @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.error("{{ session('error') }}");
        @endif

            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.info("{{ session('info') }}");
        @endif

            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.warning("{{ session('warning') }}");
        @endif
    </script>
@endif
{{--@if(session()->has('alert'))--}}
{{--    <script>--}}
{{--        window.dispatchEvent(new CustomEvent('alert', {--}}
{{--            detail: {type:'{{session()->get('alert')['type']}}',message:'{{session()->get('alert')['message']}}'}--}}
{{--        }));--}}

{{--    </script>--}}
{{--    @php--}}
{{--        Illuminate\Support\Facades\Session::forget('alert')--}}
{{--    @endphp--}}
{{--@endif--}}

<div id="auth">
    {{ $slot }}
</div>

{{--@jquery--}}
{{--@toastr_js--}}
{{--@toastr_render--}}
</body>
@livewireScripts
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>--}}
{{--<scripcleart src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></scripcleart>--}}
{{--<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('js/main.js') }}" data-turbolinks-eval="true" defer></script>--}}

<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
<script>
$(document).ready(function(){
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "preventDuplicates": true,
            "preventOpenDuplicates": true
        }
    });
})

    {{--window.dispatchEvent(new CustomEvent('alert', {--}}
    {{--    detail: {type:'{{session()->get('alert')['type']}}',message:'{{session()->get('alert')['message']}}'}--}}
    {{--}));--}}
    //     window.onload = function() {
    //     window.addEventListener('alert', event => {
    //         toastr[event.detail.type](event.detail.message,
    //             event.detail.title ?? ''), toastr.options = {
    //             "closeButton": true,
    //             "progressBar": true,
    //             "preventDuplicates": true,
    //             "preventOpenDuplicates": true
    //         }
    //     });
    // }

    // window.livewire.on('alert', data => {
    //     const type = data[0];
    //     const message = data[1];
    //     toastr.success('Have fun storming the castle!', 'Miracle Max Says');
    // });
    // document.addEventListener("turbolinks:request-start", function(event) {
    //     var xhr = event.data.xhr
    //     xhr.setRequestHeader("X-Request-Id", "123...")
    // })

    document.addEventListener('livewire:load', function (event) {
        window.livewire.on('redirect', param => {
            Turbolinks.visit(param)

        })
    })
</script>

@stack('scripts')
</html>
