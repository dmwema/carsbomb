<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Cars BOMB - {{ $player->username }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/pricing/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">

    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid py-3" style="padding: 0; overflow-x: hidden;">
        <header class="px-5">
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <div style="width: 100px; height: auto;"><img src="{{ asset('assets/images/LOGO CARSBOMB.png') }}" class="me-2" style="width: 100%;" alt="logo"></div>
                </a>
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="menu-link me-3 btn btn-dark py-2 text-light text-decoration-none" href="{{ route('public.profile.account') }}">MON COMPTE</a>
                </nav>
            </div>
            <div class="spectator-menu text-center mb-5" style="margin-top: -50px;">
                <h1 class="fw-bold" style="color: #fff">{{ $player->username }}</h1>
                <div class="solde">
                    <p style="color: red; font-size: 25px; font-weight: bold;">Solde : {{ $solde . ' €'}}</p>
                </div>
            </div>
        </header>

        <main style="margin: 0; padding: 0;">
            <div class="game-description" style="padding-bottom: 80px;">
                <div class="row">
                    <div class="col-md-2 vertical-pub-bar" style="height: 350px; background-color: red;">PUB</div>
                    <div class="col-md-8 text-center" style="padding: 0 40px;">
                        <h4 style="text-transform: uppercase; color: #121212; font-weight: bold;">Actuellement <span style="color: red;">{{ $onlines }}</span> joueurs en <span style="color: green;">Ligne</span></h4>
                        <div>
                            <a href="{{ route('public.server.new') }}" class="biglink btn">CREER UN SERVEUR</a>
                        </div>
                        <div>
                            <a href="{{ route('public.server.find') }}" class="biglink btn">RECHERCHER UN SERVEUR</a>
                        </div>
                        <div>
                            <a href="#" class="biglink btn">MODE SPECTATEUR</a>
                        </div>
                    </div>
                    <div class="col-md-2 vertical-pub-bar" style="height: 350px; background-color: red;">PUB</div>
                </div>
            </div>
        </main>

        @include('partials.footer')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js " integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF " crossorigin="anonymous "></script>
</body>

</html>