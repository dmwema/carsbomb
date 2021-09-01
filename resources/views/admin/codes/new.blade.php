<?php

$page = 'codes bomb';
$title = 'Créer un nouveau code bomb';

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
                <h4 class="card-title">Créer un nouveau code bomb</h4>
                <form class="forms-sample" enctype="multipart/form-data" method="POST" action="{{ route('code.store') }}" >
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="code">
                        @error('code')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="value">Valeur du gain (en %)</label>
                        <input type="text" name="value" class="form-control" id="value" placeholder="Valeur du gain (en %)">
                        @error('value')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end">Date d'expiration</label>
                        <input type="date" name="end" class="form-control" id="end" placeholder="Date d'expiration">
                        @error('end')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                </form>           
            </div>
            </div>
        </div>
    </div>
</div>

@endsection