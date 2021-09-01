<!doctype html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>CarsBomb - Pour la première fois ton adversaire n'est pas l'ordinateur</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">

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
</head>

<body>
    <div class="container-fluid py-3" style="padding: 0; overflow-x: hidden;">
        <header class="px-5">
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <div style="width: 100px; height: auto;"><img src="{{ asset('assets/images/LOGO CARSBOMB.png') }}" class="me-2" style="width: 100%;" alt="logo"></div>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    @if (auth_player())
                    <a class="menu-link me-3 btn btn-dark py-2 text-light text-decoration-none" href="{{ route('public.profile.account') }}">MON COMPTE</a>
                    @else
                    <a class="menu-link me-3 btn btn-dark py-2 text-light text-decoration-none" href="{{ route('public.register') }}">INSCRIPTION</a>
                    <a class="menu-link me-3 btn btn-dark py-2 text-light text-decoration-none" href="{{ route('public.login') }}">CONNEXION</a>
                    @endif 
                </nav>
            </div>
        </header>

        <main style="margin: 0; padding: 0;">

            <div class="pub-banner ">
                <p>publicite</p>
            </div>

            <div class="pricing-header p-5 pb-md-4 mx-auto text-center ">
                <h3 class="fw-bold " style="color: red; ">POUR LA PREMIERE FOIS TON ADVERSAIRE N’EST PAS L’ORDINATEUR !</h3>
                <p class="fs-5 text-muted ">La balle est dans ton camp !</p>
            </div>

            <div class="game-description ">
                <div class="row ">
                    <div class="col-sm-3 text-center ">
                        <h2>Comment jouer ?</h2><br>
                        <div>
                            <h3>
                                Il te suffit de t’inscrire
                            </h3>
                            <br>
                            <h3>
                                De trouver ton serveur idéal
                            </h3>
                            <br>
                            <h3>
                                De faire confiance a ton instinct
                            </h3>
                            <br>
                            <h3>
                                Et de fructifier ton Argent
                            </h3>
                        </div>
                    </div>
                    <div class="col-sm-9 ">
                        <img src="{{ asset('assets/images/game-illustration.png') }}" style="width: 100%; " alt="game illustration ">
                    </div>
                </div>
                <div class="row mt-5 text-center ">
                    <div>
                        <a href="{{ route('public.register') }}" class="game-action btn "><span class="play ">Je veux jouer</span> <small>(Inscription en 30 sec)</small></a>
                        <a href="{{ route('public.server.find') }}" class="game-action btn ">Mode spectateur</a>
                    </div>
                    <div class="pricing-header p-5 pb-md-4 mx-auto text-center ">
                        <h3 class="fw-bold " style="color: #fff; text-transform: uppercase; ">Triomphe sur tes adversaires Ton instinct est ta meilleure arme !</h3>
                        <h2 class="fw-bold mt-5 text-bordered fw-bold " style="color: red; text-transform: uppercase; ">ALORS COMMENCE DES MAINTENANT A ENCAISSER...</h2>
                    </div>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js " integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF " crossorigin="anonymous "></script>
</body>

</html>