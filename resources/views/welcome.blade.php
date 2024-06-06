<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('Servifacil', 'Servifacil') }}</title>

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
            margin: 0;
            padding: 0;
        }

        a {
            color: grey;
            /* Color gris para los enlaces */
        }

        .logo {
            width: 50%;
            height: auto;
            margin: 5% auto;
            display: block;
            max-width: 200px;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .footer {
            padding: 1rem;
            background-color: #e4d8c5;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .container {
            padding: 0 15px;
        }

        .card-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 10%;
        }

        .card-intro {
            background-color: #e4d8c5;
            width: 80%;
            max-width: 400px;
            text-align: center;
            padding: 20px;
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

        @media screen and (max-width: 768px) {
            .card-intro {
                width: 90%;
            }
        }
    </style>
</head>

<body class="antialiased">
    <img src="{{ asset('favicon.ico') }}" alt="Logo" class="logo">

    <div class="top-right links">
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a href="{{ url('home') }}" class="home-btn">home</a>
                @else
                    <a href="{{ route('login') }}" class="login-btn">{{ __('Iniciar sesión') }}</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="register-btn">{{ __('Registrarme') }}</a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>

    <div class="container text-center">
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
                    <p>AdminLTE es una plantilla de administración que es completamente gratuita y de código
                        abierto...
                    </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat consequat.</p>
                </div>
            </a>
        </div>
    </div>

    <footer class="footer py-2 text-center text-sm">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
