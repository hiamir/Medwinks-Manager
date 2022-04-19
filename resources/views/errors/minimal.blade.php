<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>@yield('code') @yield('title')</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

    <!-- Custom stlylesheet -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
    <body class="antialiased">


    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404"></div>
            <h1>@yield('code')</h1>
            <h2>@yield('title')</h2>
            <p> @yield('message')</p>
            <a href="#">Back to homepage</a>
            <a href="{{ url('/logout') }}"> logout </a>
        </div>
    </div>


{{--        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">--}}
{{--            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">--}}
{{--                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">--}}
{{--                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">--}}
{{--                        @yield('code')--}}
{{--                    </div>--}}

{{--                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">--}}
{{--                        @yield('message')--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </body>
</html>
