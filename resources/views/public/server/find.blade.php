<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>CarsBomb - Recherche d'un serveur</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/pricing/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">

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
                    <p style="color: red; font-size: 25px; font-weight: bold;">Solde : {{ $solde }}€</p>
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
            
                @if (Session::get('server_joined') != null)
                    <div class="alert alert-danger mt-4">
                    <p>Vous avez rejoint le serveur avec succès</p>
                    </div>
                @endif
            
                @if (Session::get('server_quit') != null)
                    <div class="alert alert-danger mt-4">
                    <p>Vous avez quitté le serveur avec succès</p>                    
                    </div>
                @endif
            </div>
            <div class="pub-banner ">
                <p>publicite</p>
            </div>

            <div class="game-description" style="padding-bottom: 80px;">
                <h1 style="text-align: center;">Recherche d'un serveur</h1>
                <hr>
                <form action="#">
                    <div id="criteres" class="row">
                        <div class="col-md-4 ">
                            <h3 style="color: red; ">CRITERES SPECIFIQUES</h3>
                            <div class="fiel-container ">
                                <label for="amount ">MISE MAX (€)</label>
                                <input class="form-control " type="text " id="amount ">
                            </div>
                        </div>
                        <div class="col-md-8 ">
                            <div class="fiel-container ">
                                <label for="server_name">NOM D’UN SERVEUR #</label>
                                <input type="text" class="form-control" id="server_name">
                            </div>
                            <div class="fiel-container ">
                                <label for="max_players ">NOMBRE DE JOUEURS max</label>
                                <select class="form-select " aria-label="Default select example ">
                                    <option value="0"></option>
                                    <option value="1">3</option>
                                    <option value="2">5</option>
                                    <option value="3">10</option>
                                    <option value="3">15    </option>
                                    <option value="3">25</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-dark mt-5" id="servers_table" style="color: #fff;">
                        <tbody>
                            @foreach ($servers as $server)
                            <tr>
                                <td class="td_name">{{ $server->name }}</td>
                                <td>MISE : {{ $server->amount }} €</td>
                                <td>JOUEURS DANS LE SERVEUR : {{ $servers_members[$server->id] . ' / ' . $server->max_players }}</td>
                                <td>
                                    @if ($is_players_server[$server->id])
                                    <a style="color:rgb(238, 168, 110)" class="mr-5" href="{{ route('public.game.play', ['server_id' => $server->id]) }}">Jouer</a>
                                    <a style="color:rgb(238, 168, 110)" href="{{ route('public.server.quit', ['server_id' => $server->id]) }}">Quitter ce serveur</a>   
                                    @else
                                    <a style="color:rgb(238, 168, 110)" href="{{ route('public.server.join', ['server_id' => $server->id]) }}">Rejoindre ce serveur</a>   
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('public.profile') }}" class="game-action btn ">Retour au menu principal</small></a>
            </div>
    </div>
    </main>

    @include('partials.footer')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            function filter_servers (value) {

            }

            $("#server_name").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                console.log(value)
                $("#servers_table tr").filter(function() {
                    $(this).toggle($("td.td_name", this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $("#amount").on("keyup", function() {
                var value_str = $(this).val()
                var value = parseFloat(value_str);
                
                $("#servers_table tr").filter(function() {
                    if (value_str == '') {
                        $(this).toggle(true)
                    } else {
                        $(this).toggle(parseFloat($("td.td_amount span", this).text()) <= value)
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js " integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF " crossorigin="anonymous "></script>
</body>

</html>