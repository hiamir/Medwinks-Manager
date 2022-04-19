<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OMJ Manager') }}</title>

    <!-- Scripts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mazer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    @livewireStyles

{{--    <link rel="stylesheet" href="assets/css/bootstrap.css">--}}
{{--    <link rel="stylesheet" href="assets/vendorss/bootstrap-icons/bootstrap-icons.css">--}}
{{--    <link rel="stylesheet" href="assets/css/app.css">--}}
{{--    <link rel="stylesheet" href="assets/css/pages/auth.css">--}}
</head>

<body>
<div id="auth">
    {{ $slot }}


</div>
</body>
@livewireScripts
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
<script>
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "preventDuplicates": true,
            "preventOpenDuplicates": true
        }
    });

    document.addEventListener('livewire:load', function (event) {
        window.livewire.on('redirect', param => {
            Turbolinks.visit(param)
        })
    })
    // document.addEventListener("turbolinks:request-start", function(event) {
    //     var xhr = event.data.xhr
    //     xhr.setRequestHeader("X-Request-Id", "123...")
    // })
</script>
@stack('scripts')
</html>
