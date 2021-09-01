<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <title>{{ 'CarsBomb  - ' . $page ?? 'CarsBomb' }}</title>
</head>
<body>
    <div class="container-fluid py-3" style="padding: 0; overflow-x: hidden;">
        <header class="px-5">
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <div style="width: 100px; height: auto;"><img src="{{ asset('assets/images/LOGO CARSBOMB.png') }}" class="me-2" style="width: 100%;" alt="logo"></div>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="menu-link me-3 btn btn-dark py-2 text-light text-decoration-none" href="{{ route('public.register') }}">INSCRIPTION</a>
                    <a class="menu-link me-3 btn btn-dark py-2 text-light text-decoration-none" href="{{ route('public.login') }}">CONNEXION</a>
                </nav>
            </div>
            <div class="spectator-menu text-center mb-5" style="margin-top: -50px;">
                <h1 class="fw-bold" style="color: #fff">{{ $maintitle }}</h1>
                <div class="links">
                    <a class="menu-link me-3 btn btn-dark py-2 text-light text-decoration-none" href="{{ route('home') }}">Retour à la page principale</a>
                </div>
            </div>
        </header>

        <main style="margin: 0; padding: 0;"> 
            <div class="pub-banner ">
                <p>publicite</p>
            </div>
            <div class="game-description" style="padding-bottom: 80px;">
                <div class="row ">
                    @yield('content')
                </div>
            </div>
        </main>
        @include('partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js " integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF " crossorigin="anonymous "></script>
    <script src="{{ asset('js/prev.js') }}"></script>
</body>

</html>
