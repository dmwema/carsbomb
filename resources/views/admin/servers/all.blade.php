<?php 

$page = 'servers';
$title = 'Tous les serveurs';

$i = 0;

$types = [
    1 => 'Réel', 
    2 => 'Fictif'
];

?>

@extends('admin.layout.main')

@section('content')
<div class="row" id="proBanner">
    <div class="col-12">
      <span class="d-flex align-items-center purchase-popup">
        <p></p>       
        <a href="#" class="btn btn-inverse-primary btn-fw ml-auto"><i class="mdi mdi-plus "></i> Nouveau serveur </a>
      </span>
    </div>
  </div>
<div class="row">
  <div class="col-sm-12">
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ Session::get('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Serveurs</h4>
        @if (count($servers) == 0)
            <p class="card-description">Aucun serveur créé</p>
        @else
            <p class="card-description">{{ count($servers) }} serveurs affichés sur {{ $count }}</code>
        @endif
        </p>
        <div class="table-bordered table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> # </th>
                <th> Nom </th>
                <th> Mise minimale </th>
                <th> Max joueurs </th>
                <th> Type </th>
                <th> Créateur </th>
                <th> Date de création </th>
                <th> Actions </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($servers as $server)

                @php
                  $i++;   
                @endphp
                
                <tr>
                  <td> {{ $i }} </td>
                  <td> {{ $server->name }} </td>
                  <td> {{ $server->amount . ' €' }} </td>
                  <td> {{ $server->max_players }} </td>
                  <td> {{ $types[$server->type] }} </td>
                  <td> {{ $creators[$server->id]->firstname . ' ' . $creators[$server->id]->lastname . ' (' . $creators[$server->id]->pseudo .')' }} </td>
                  <td> {{ \Carbon\Carbon::parse($server->created_at)->format('d/m/Y') }} </td>
                  <td>    
                    <form action="{{ route('server.delete', ['id' => $server->id]) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur ? Toute suppression d\'un joueur est définitive et cette dernière est supprimée de la base de données')" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      @csrf
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('server.edit', ['id' => $server->id]) }}" title="Modifier" type="button" class="btn btn-outline-primary">
                            <i class="mdi mdi-grease-pencil"></i>
                        </a>
                        <button title="Supprimer" type="submit" class="btn btn-outline-danger">
                          <i class="mdi mdi-delete "></i>
                        </button>
                      </div>
                    </form>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $servers->links() }}
      </div>
    </div>
  </div>
</div>

<!-- modale -->

@endsection