<!doctype html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>CarsBomb - Créer un serveur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/font-awesome-4.7.0/css/font-awesome.min.css') }}">

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
                    <p style="color: red; font-size: 25px; font-weight: bold;">Solde : {{ $solde . '€'}}</p>
                </div>
            </div>
        </header>

        <main style="margin: 0; padding: 0;">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="pub-banner ">
                <p>publicite</p>
            </div>

            <div class="game-description" style="padding-bottom: 80px;">
                <h1 style="text-align: center;">Faire un depot</h1>
                <form action="{{ url('charge') }}" class="row" method="POST">
                    @csrf
                    <div class="col-md-6 offset-md-3">
                        <div style="margin-bottom: 10px;">
                            <label for="amount">Montant à deposer (en €):</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="buttons">
                            <button class="btn btn-danger" type="submit">Payer</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        @include('partials.footer')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js " integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF " crossorigin="anonymous "></script>
</body>

</html>
