<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->

                    @if(Auth::check())
                        <a class="navbar-brand"
                           href="{{
                           auth()->user()->isSupervisor() ? getenv('DASHBOARD_SUPERVISOR_URL') :
                            auth()->user()->isLider() ? getenv('DASHBOARD_LIDER_URL') :
                            auth()->user()->isOperador() ? getenv('DASHBOARD_OPERADOR_URL') :
                            '/home'
                            }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    @endif


                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if(Auth::check())
                        @include('layouts.left-navbar')
                    @endif

                    <!-- Right Side Of Navbar -->
                    @include('layouts.right-navbar')
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
