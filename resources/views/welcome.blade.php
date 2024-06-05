<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #A39A8B;
            color: white;
        }

        a {
            color: grey;
            /* Color gris para los enlaces */
        }

        .logo {
            width: 200px;
            height: auto;
            margin: 50px auto;
            display: block;
        }

        .card-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 80px;
            margin-top: 50px;
        }

        .card-intro {
            background-color: #e4d8c5;
            width: 400px;
            height: 100%;
            text-align: center;
            padding: 20px;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            padding: 1rem;
            background-color: #e4d8c5;
        }

        .login-btn,
        .register-btn,
        .home-btn {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
        }

        .card-title {
            font-weight: bold;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container text-center">
        <img src="{{ asset('favicon.ico') }}" alt="Logo" class="logo">

        <div class="top-right links">
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a href="{{ url('home') }}" class="home-btn">home</a>
                    @else
                        <a href="{{ route('login') }}" class="login-btn">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="register-btn">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>

        <div class="card-wrapper">
            <a href="https://laravel.com/docs" class="card card-intro">
                <div class="card-header">
                    <h3 class="card-title">Introducción a la Aplicación</h3>
                </div>
                <div class="card-body">
                    <p>Bienvenido a nuestra aplicación. Aquí puede encontrar una breve introducción sobre lo que hace
                        nuestra aplicación...</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </a>
            <a href="https://adminlte.io/docs/3.1/" class="card card-intro">
                <div class="card-header">
                    <h3 class="card-title">Introducción a AdminLTE</h3>
                </div>
                <div class="card-body">
                    <p>AdminLTE es una plantilla de administración que es completamente gratuita y de código abierto...
                    </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat consequat.</p>
                </div>
            </a>
        </div>
    </div>

    <footer class="footer py-16 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
