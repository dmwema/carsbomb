<?php

$page = 'codes bomb';
$title = 'Modifier le code bomb';

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
                <h4 class="card-title">Modifier le code bomb</h4>
                <form class="forms-sample" enctype="multipart/form-data" method="POST" action="{{ route ('code.update', ['id' => $code->id]) }}" >
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="exampleTextarea1">Code</label>
                        <input type="text" name="code" value="{{ $code->code }}" class="form-control" id="exampleInputName1" placeholder="code">
                        @error('code')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="value">Valeur du gain (en %)</label>
                        <input type="text" name="value" value="{{ $code->value }}" class="form-control" id="value" placeholder="Nombre de pièces à gagner">
                        @error('value')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Date de créeation</label>
                        <input type="date" name="date_cr" value="{{ \Carbon\Carbon::parse($code->created_at)->format('Y-m-d') }}" class="form-control" id="date" disabled placeholder="Date de création">
                    </div>
                    <div class="form-group">
                        <label for="date_edit">Date de dernière modification</label>
                        <input type="date" name="date_edit" value="{{ \Carbon\Carbon::parse($code->updated_at)->format('Y-m-d') }}" class="form-control" id="date_edit" disabled placeholder="Date de dernière modification">
                    </div>
                    <div class="form-group">
                        <label for="end">Date d'expiration</label>
                        <input type="date" name="end" value="{{ \Carbon\Carbon::parse($code->end)->format('Y-m-d')}}" class="form-control" id="end" placeholder="Date d'expiration">
                        @error('end')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                    <button onclick="
                        let result = confirm('Êtes-vous sûr de vouloir supprimer ce code bomb ? Toute suppression d\'un code bomb est définitive et ce dernier est supprimé de la base de données')
                        event.preventDefault()
                        if (result) {
                            document.getElementById('delete-code').submit()
                        }
                    " class="btn btn-danger mr-2">Supprimer</button>
                </form>                    
                <form id="delete-code" action="{{ route('code.delete', ['id' => $code->id]) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    @csrf
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection