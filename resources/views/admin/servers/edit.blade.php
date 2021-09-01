<?php

$page = 'servers';
$title = 'Modifier le server';

$types = [
    1 => 'Réel', 
    2 => 'Fictif'
];

?>
@extends('admin.layout.main')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! config('app.EMPTY_FIELDS') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier le Serveur</h4>
                <form class="forms-sample" enctype="multipart/form-data" method="POST" action="{{ route ('server.update', ['id' => $server->id]) }}" >
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" name="name" value="{{ $server->name }}" class="form-control" id="name" placeholder="Nom">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="amount">Mise minimale (en €)</label>
                        <input type="text" name="amount" value="{{ $server->amount }}" class="form-control" id="amount" placeholder="Mise minimale (en €)">
                        @error('amount')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="max_players">Max joueurs</label>
                        <input type="text" name="max_players" value="{{ $server->max_players }}" class="form-control" id="max_players" placeholder="Mix joueurs">
                        @error('max_players')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Type de serveur</label>
                        <select class="form-control" name="type" id="type">
                            @foreach ($types as $k => $type)
                                <option value="{{ $k }}" <?= $server->type == $k ? 'selected': '' ?>>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="creator">Créateur</label>
                        <input type="text" name="creator" value="{{ $creator->firstname . ' ' . $creator->lastname . ' (' . $creator->username .')' }}" class="form-control" id="creator" disabled placeholder="Créateur">
                        @error('creator')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Date de créeation</label>
                        <input type="date" name="date_cr" value="{{ \Carbon\Carbon::parse($server->created_at)->format('Y-m-d') }}" class="form-control" id="date" disabled placeholder="Date de création">
                    </div>
                    <div class="form-group">
                        <label for="date_edit">Date de dernière modification</label>
                        <input type="date" name="date_edit" value="{{ \Carbon\Carbon::parse($server->updated_at)->format('Y-m-d') }}" class="form-control" id="date_edit" disabled placeholder="Date de dernière modification">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                    <button onclick="
                        let result = confirm('Êtes-vous sûr de vouloir supprimer ce Serveur ? Toute suppression d\'un serveur est définitive et ce dernier est supprimé de la base de données')
                        event.preventDefault()
                        if (result) {
                            document.getElementById('delete-server').submit()
                        }
                    " class="btn btn-danger mr-2">Supprimer</button>
                </form>                    
                <form id="delete-server" action="{{ route('server.delete', ['id' => $server->id]) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    @csrf
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection