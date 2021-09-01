@extends('public.auth.layout.main')
@section('content')
@php
    $maintitle = "INSCRIPTION";
    $page = "Inscription";
@endphp
<form action="{{ route('public.register.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row text-center">
        <div class="col-md-6 text-center">
            <div class="fiel-container">
                <label for="lastname">nom</label>
                <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{old('lastname')}}" id="lastname">
            </div>
            <div class="fiel-container">
                <label for="firstname">prenom</label>
                <input type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{old('firstname')}}" name="firstname" id="firstname">
            </div>
            <div class="fiel-container">
                <label for="email">Adresse email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" id="email">
            </div>
            <div class="fiel-container">
                <label for="birthday">Date de naissance</label>
                <input type="date" class="form-control @error('birthday') is-invalid @enderror" value="{{old('birthday')}}" name="birthday" id="birthday">
            </div>
            <div class="fiel-container">
                <label for="country">Pays de domicialisation</label>
                <input type="text" class="form-control @error('country') is-invalid @enderror" value="{{old('country')}}" name="country" id="country">
            </div>
            <div class="fiel-container">
                <label for="adress1">Adresse postale</label>
                <input type="text" value="{{old('postal_adress')}}" name="postal_adress" class="form-control @error('postal_adress') is-invalid @enderror" id="adress1">
            </div>
            <div class="fiel-container">
                <label for="adress2">Complément adresse</label>
                <input type="text" value="{{old('compl_adress')}}" class="form-control @error('compl_adress') is-invalid @enderror" name="compl_adress" id="adress2">
            </div>
            <div class="fiel-container">
                <label for="code1">Code postale</label>
                <input type="text" value="{{old('postal_code')}}" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="code1">
            </div>
            <div class="cgu">
                <a href="">Voir nos conditions générales</a>
            </div>
            <div class="fiel-container">
                <span for="major"><input type="checkbox" class="form-check-input" {{old('major') ? 'checked': ''}} name="major" id="major"> Je certifie avoir plus de 18 ans (majeur)</span>
            </div>
            <div class="fiel-container">
                <span for="cgu"><input  type="checkbox" class="form-check-input" {{old('cgu') ? 'checked': ''}} name="cgu" id="cgu"> J'ai lu et j'accepte les conditions générales et la politique de confidentialité.</span>
            </div>
        </div>
        <div class="col-md-6" style="text-align: left;">
            <div class="fiel-container">
                <label for="username">pseudo</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}" name="username" id="username">
            </div>
            <div class="fiel-container">
                <label>mot de passe</label>
                <input value="{{old('pw')}}" class="form-control @error('pw') is-invalid @enderror" type="password" name="pw">
            </div>
            <div class="fiel-container">
                <label>confirmer mot de passe</label>
                <input type="password" value="{{old('pw_confirmation')}}" class="form-control @error('pw_confirmation') is-invalid @enderror" name="pw_confirmation">
            </div>
            <div class="fiel-container">
                <label for="image">Image de profile</label>
                <input type="file" name="image" value="{{old('image')}}" class="@error('image') is-invalid @enderror" onchange="preview_image(event)" id="image">
            </div>
            <div class="img-prev d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/profile.jpg') }}" id="output_image" style="width: 150px;">
                <p style="padding-left: 15px; color: #dada03; font-size: 13px;">Tout image ou pseudo incitant à la haine, caractère discriminatoire ou sexuel peut entrainer un blocage définitif du compte</p>
            </div>
            <div class="fiel-container">
                <label for="credit_card">Numéro de la carte bancaire</label>
                <input type="text" class="form-control @error('credit_card') is-invalid @enderror" value="{{old('credit_card')}}" name="credit_card" id="credit_card">
            </div>
            <p style="padding-left: 15px; color: #dada03; font-size: 13px;">Oublier pas d'envoyer vos justificatifs d'identité et bancaire dans l'onglet Mon compte > Envoyer mes documents sous 30 jours</p>
            <div class="fiel-container">
                <label>Pseudo du parrain (facultatif)</label>
                <input  class="form-control @error('parent') is-invalid @enderror" type="text" value="{{old('parent')}}" name="parent">
            </div>
            <div class="submit mt-5">
                <button type="submit" class="btn btn-danger">Valider mon inscription</button>
            </div>
        </div>
    </div>
</form>
@endsection