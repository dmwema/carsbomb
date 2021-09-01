<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarsBomb - {{ $player->username }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        h3 {
            font-size: 15px;
            text-transform: uppercase;
        }
        h4 {
            font-size: 13px;
            text-transform: uppercase;
        }
        .preview {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col dashbord">
                <div class="profile d-flex align-items-center justify-content-start">
                    <img src="{{ $player->image == null ? asset('assets/images/profile.jpg'): asset("assets/images/players/$player->image ") }}" alt="profile">
                    <div class="names">
                        <h3 class="name">{{ $player->firstname . ' ' . $player->lastname }}</h3>
                        <p>{{ $player->username }}</p>
                        <p>{{ $player->email }}</p>
                    </div>
                </div>
                <hr>
                <div class="row money mt-4">
                    <div class="col">
                        <p>Depôts</p>
                        <h3>{{ $depots }}€</h3>
                        <i class="fas fa-money-check"></i>
                    </div>
                    <div class="col">
                        <p>Gains</p>
                        <h3>{{ $wins }}€</h3>
                    </div>
                    <div class="col">
                        <p>Pertes</p>
                        <h3>{{ $looses }}€</h3>
                    </div>
                    <div class="col">
                        <p>Solde</p>
                        <h3>{{ $solde }}€</h3>
                    </div>
                    <p class="mt-4">
                        <a href="{{ route('public.logout') }}" class="btn btn-danger">Se deconnecter</a>
                        <a href="{{ route('public.profile') }}" class="btn btn-primary">Retour au menu</a>
                    </p>
                </div>
            </div>
            <div class="col details py-5">
                <div class="tabs">
                    <div class="row">
                        <div class="col active parent-tab">
                            <a href="#bio" class="title">bio</a>
                        </div>
                        <div class="col parent-tab">
                            <a href="#payment" class="title">Paiement</a>
                        </div>
                        <div class="col parent-tab">
                            <a href="#servers" class="title">Serveurs</a>
                        </div>
                        <div class="col parent-tab">
                            <a href="#bomb" class="title">Code Bomb</a>
                        </div>
                    </div>
                    <hr class="separate">
                </div>
                <div>
                    <div class="contents payment" id="payment-content">
                        <div class="tab-contents mt-4">
                            <div class="row">
                                <h3>Coordonnées</h3>
                                <table class="table">
                                    <td class="credit-card-title">Carte de crédit :</td>
                                    <td class="credit-card">{{ $player->credit_card == null ? 'Aucun': $player->credit_card  }}</td>
                                    <td class="edit"><i class="fas fa-pencil"></i> <a href="{{ route('profile.edit') }}" style="text-decoration: none;">Modifier</a></td>
                                </table>
                            </div>
                        </div>
                        <div class="tab-contents">
                            <div class="row">
                                <h3>Actions</h3>
                                <div class="d-flex">
                                    <p>
                                        <a href="{{ route('public.withdrawal.new') }}" class="btn btn-primary">Démander un rétrait</a>
                                    </p>
                                    <p style="margin-left: 10px;">
                                        <a href="{{ route('depot') }}" class="btn btn-primary">Faire un dépot</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contents servers" id="servers-content">
                        <div class="tab-contents">
                            <div class="row">
                                <h3>Serveurs que vous avez créés</h3>
                                <table class="table mb-4">
                                    <thead>
                                        <th>Nom</th>
                                        <th>Date de création</th>
                                        <th>Nombre des joueurs</th>
                                        <th>Mise</th>
                                        <tbody>
                                            @foreach ($users_created_servers as $users_created_server)
                                            <tr>
                                                <td>{{ $users_created_server->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($users_created_server->created_at)->format('d/m/Y') }}</td>
                                                <td>{{ $users_created_server->max_players }}</td>
                                                <td>{{ $users_created_server->amount }}€</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-contents">
                            <div class="row">
                                <h3>Serveurs où vous jouez</h3>
                                <table class="table">
                                    <thead>
                                        <th>Nom</th>
                                        <th>Date de création</th>
                                        <th>Nombre des joueurs</th>
                                        <th>Mise</th>
                                        <tbody>
                                            @foreach ($users_servers as $users_server)
                                            <tr>
                                                <td>{{ $users_server->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($users_server->created_at)->format('d/m/Y') }}</td>
                                                <td>{{ $users_server->max_players }}</td>
                                                <td>{{ $users_server->amount }}€</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-contents">
                            <div class="row">
                                <h3>Actions</h3>
                                <div class="d-flex">
                                    <p>
                                        <a href="{{ route('public.server.find') }}" class="btn btn-primary">Chercher un serveur</a>
                                    </p>
                                    <p style="margin-left: 10px;"> 
                                        <a href="{{ route('public.server.new') }}" class="btn btn-primary">Créer un serveur</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contents bio active" id="bio-content">
                        <div class="tab-contents">
                            <div class="row">
                                @if ($player->status == ACCOUNT_WAITING)
                                    @if ($hascards)
                                        <div class="alert alert-info">
                                            <b>Votre compte est en attente de validation</b><br>
                                            <hr>
                                            <b>Votre compte est en cours de validation</b><br>
                                            Merci d'avoir envoyé vos pièces administratives.
                                        </div>
                                    @else  
                                        <div class="alert alert-warning">
                                            <b>Votre compte est en attente de validation</b><br>
                                            Veuillez envoyer vos pièces administratives
                                        </div>
                                    @endif
                                @elseif ($player->status == ACCOUNT_VALIDATED)
                                    
                                <div class="alert alert-success">
                                     <b>Votre compte est validé</b><br>
                                    Merci de nous avoir fait confiance
                                </div>
                                @elseif ($player->status == ACCOUNT_REFUSED)
                                <div class="alert alert-danger">
                                     <b>Votre compte est réfusé</b><br>
                                </div>
                                @endif
                                <h3>Informations personnelles</h3>
                                <table class="table">
                                    <thead>
                                        <tbody>
                                            <tr>
                                                <td>Nom</td>
                                                <td style="font-weight: 700;">{{ $player->lastname }}</td>
                                            </tr>
                                            <tr>
                                                <td>Prénom</td>
                                                <td style="font-weight: 700;">{{ $player->firstname }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pseudo</td>
                                                <td style="font-weight: 700;">{{ $player->username }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td style="font-weight: 700;">{{ $player->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Adresse</td>
                                                <td style="font-weight: 700;">{{ $player->adress }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pays</td>
                                                <td style="font-weight: 700;">{{ $player->country }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date de création de compte</td>
                                                <td style="font-weight: 700;">{{ $player->created_at }}</td>
                                            </tr>
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-contents">
                            <div class="row">
                                <h3>Actions</h3>
                                <div class="d-flex">
                                    <p>
                                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Modifier le profil</a>
                                    </p>
                                    <p style="margin-left: 10px;">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#sendCards"  class="btn btn-primary">Envoyer les pièces administratives</a>
                                    </p>
                                    <p style="margin-left: 10px;">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteAccount" class="btn btn-danger">Supprimer le compte</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contents bomb" id="bomb-content">
                        <div class="tab-contents">
                            <div class="tab-contents">
                                <div class="row">
                                    <h3 class="mb-4">Codes bomb</h3>
                                    @if (Session::get('code_error') != null)
                                    <div class="alert alert-danger" style="display: flex; justify-content: space-between">
                                        <span>{{ Session::get('code_error') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
                                    </div>
                                    @endif                                    
                                    @if (Session::get('code_success') != null)
                                    <div class="alert alert-success" style="display: flex; justify-content: space-between">
                                        <span>{{ Session::get('code_success') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
                                    </div>
                                    @endif
                                    <form action="{{ route('public.code.use') }}" method="POST">
                                        @csrf
                                        <div>
                                            <label class="labels mb-2" style="font-size: 12px">Entrez le code</label>
                                            <input type="text" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror" placeholder="Entrez le code"  name="code">
                                            @error('code')
                                                <small class="text-danger">Vous devez entrer un code</small>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class ="btn btn-primary">Valider</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="tab-contents">
                                <h3>Codes bomb utilisés</h3>
                                <table class="table">
                                    <thead>
                                        <th>Code</th>
                                        <th>Date du début</th>
                                        <th>Date de la fin</th>
                                        <th>Valeur du gain</th>
                                        <th>Etat</th>
                                        <tbody>
                                            @foreach ($used_bombs as $bomb)
                                                <tr>
                                                    <td>{{ $bomb->code }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($bomb->created_at)->format('d/m/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($bomb->end)->format('d/m/Y') }}</td>
                                                    <td>{{ $bomb->value }}%</td>
                                                    @if (\Carbon\Carbon::createFromDate($bomb->end)->gte(Carbon\Carbon::now()))
                                                        <td> <b class="text-success">En cours</b> </td>
                                                    @else    
                                                        <td> <b class="text-danger">Expiré</b> </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="deleteAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Supprimer le compte</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Cette oppération va supprimer toutes vos informations de notre base de données. Cette action est irreversible.
            </div>
            <div class="modal-footer">
                <form action="{{ route('public.account.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="delete" />
                    <button type="submit" class="btn btn-danger">Supprimer le compte</button>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="sendCards" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Envoyer les pièces administratives</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cards_form" enctype="multipart/form-data" action="{{ route('public.send-cards') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Pièce d’identité recto</h4>
                                <div class="preview card1 mb-4">
                                    <img id="card1" style="width: 100%;">
                                </div>
                                <input type="file" name="card_recto" id="card1_input" onchange="preview_card1(event)">
                                <small class="text-danger"  id="error_card1"></small>
                            </div>
                            <div class="col-md-6">
                                <h4>Pièce d’identité verso</h4>
                                <div class="preview mb-4 card2">
                                    <img id="card2" style="width: 100%;">
                                </div>
                                <input type="file" name="card_verso" id="card2_input" onchange="preview_card2(event)">
                                <small class="text-danger"  id="error_card2"></small>
                            </div>
                        </div>
                        <hr>
                        <div class="rib">
                            <div class="col-md-6">
                                <h4>RIB</h4>
                                <div class="preview rib mb-4">
                                    <img id="rib" style="width: 100%;">
                                </div>
                                <input type="file" name="rib" id="rib_input" onchange="preview_rib(event)">
                                <small class="text-danger"  id="error_rib"></small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" onclick="validate_files();">Valider</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="{{ asset('js/tabs.js') }}"></script>
    <script> 
        function validate_files() { 
            var card1_file = $('#card1_input').val(); 
            var card2_file = $('#card2_input').val(); 
            var rib_file = $('#rib_input').val(); 

            var allowedExtensions = 
                    /(\.jpg|\.jpeg|\.png)$/i;
            var error = 0;

            if (card1_file=="") {  
                $("#error_card1").html("Veuillez ajouter le recto de votre pièce d'identité ici");      
                error++
            } else {
                if (!allowedExtensions.exec(card1_file)) {
                    $("#error_card1").html("Veuillez placer une image valide (.jpg, .jpeg ou .png)");      
                    card1_file.value = '';
                    error++
                } else {
                    $("#error_card1").html("")
                }
            }

            if (card2_file=="") {  
                $("#error_card2").html("Veuillez ajouter le verso de votre pièce d'identité ici");    
                error++
            } else  {
                if (!allowedExtensions.exec(card2_file)) {
                    $("#error_card2").html("Veuillez placer une image valide (.jpg, .jpeg ou .png)");      
                    card1_file.value = '';
                    error++
                } else {
                    $("#error_card2").html("")
                }
            }

            if (rib_file=="") {  
                $("#error_rib").html("Veuillez ajouter votre RIB ici");     
                error++
            } else {
                if (!allowedExtensions.exec(rib_file)) {
                    $("#error_rib").html("Veuillez placer une image valide (.jpg, .jpeg ou .png)");      
                    card1_file.value = '';
                    error++
                } else {
                    $("#error_rib").html("")  
                }
            }

            if (error > 0) {
                return false;
            } else {
                $('#cards_form').submit();
            }
            
        }  
    </script> 
    <script src="{{ asset('js/prev.js') }}"></script>
</body>
</html>