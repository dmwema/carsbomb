<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carsbomb - Modifier le profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
</head>
<body>
    <div class="container rounded bg-white mb-5">
        <div>
            <form action="{{ route('profile.update') }}" class="row" method="POST">
                @csrf
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3"><img class="rounded-circle mt-5" width="150px" height="150px" src="{{ $player->image == null ? asset('assets/images/profile.png'): asset("assets/images/players/$player->image") }}">{{ $player->username }}</span><span class="text-black-50">{{ $player->email }}</span><span> </span></div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Informations personnelles</h4>
                        </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Nom</label><input type="text" name="lastname" class="form-control" placeholder="Nom" value="{{ $player->lastname }}"></div>
                                <div class="col-md-6"><label class="labels">Prénom</label><input type="text" name="firstname" class="form-control" value="{{ $player->firstname }}" placeholder="Prénom"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Date de naissance</label><input type="date" class="form-control" placeholder="Date de naissance" value="{{ $player->birthday }}" name="birthday"></div>
                                <div class="col-md-12"><label class="labels">Pays de domicialisation</label><input type="text" class="form-control" placeholder="Pays de domicialisation" value="{{ $player->country }}" name="country"></div>
                                <div class="col-md-12"><label class="labels">Adresse postale</label><input type="text" class="form-control" placeholder="Adresse postale" value="{{ $player->postal_adress }}" name="postal_adress"></div>
                                <div class="col-md-12"><label class="labels">Complément adresse</label><input type="text" class="form-control" placeholder="Complément adresse" value="{{ $player->compl_adress }}" name="compl_adress"></div>
                                <div class="col-md-12"><label class="labels">Code postale</label><input type="text" class="form-control" placeholder="Code postale" value="{{ $player->postal_code }}" name="postal_code"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Pseudo</label><input type="text" class="form-control" placeholder="Pseudo" value="{{ $player->username }}" name="username"></div>
                                <div class="col-md-6"><label class="labels">Adresse email</label><input type="email" class="form-control" placeholder="Adresse email" value="{{ $player->email }}" name="email"></div>
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Enrégistrer les modifications</button></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience"><span>Modifier le mot de passe</span></div><br>
                        <div class="col-md-12"><label class="labels">Mot de passe</label><input type="text" class="form-control" placeholder="Mot de passe" value="" name="pw"></div> <br>
                        <div class="col-md-12"><label class="labels">Confirmer le mot de passe</label><input type="text" class="form-control" placeholder="Confirmer le mot de pass" name="pw_confirmation"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>