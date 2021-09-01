@extends('public.auth.layout.main')
@section('content')
@php
    $maintitle = "CONNEXION";
    $page = "Connexion";
@endphp
<form action="{{ route('public.login.store') }}" method="POST">
    <div class="row text-center">
        <div class="col-md-6 text-center offset-md-3">
            @csrf
            <div class="fiel-container">
                <label for="identity">Pseudo ou Email</label>
                <input type="text" name="identity" class="form-control @error('identity') is-invalid @enderror" value="{{old('identity')}}" id="identity">
            </div>
            <div class="fiel-container">
                <label for="password">Mot de passe</label>
                <input type="text" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" name="password" id="password">
            </div>
            <div class="fiel-container">
                <span for="session"><input type="checkbox" name="session" id="session"> Se souvenir de moi</span>
            </div>
            <button class="btn btn-danger">Se connecter</button>
        </div>
    </div>
</form>
@endsection