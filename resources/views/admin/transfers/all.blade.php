<?php 

$page = 'joueurs';
$title = 'Tous les transfers';

$i = 0;

?>

@extends('admin.layout.main')

@section('content')
<div class="row" id="proBanner">
    <div class="col-12">
      <span class="d-flex align-items-center purchase-popup">
        <p></p>
        <a href="{{ route('admin.transfer') }}" class="btn btn-inverse-primary btn-fw ml-auto"><i class="mdi mdi-plus "></i> Nouveau transfer</a>
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
        <h4 class="card-title">Joueurs</h4>
        @if (count($transfers) == 0)
            <p class="card-description">Aucun joueur enrégistré</p>
        @else
            <p class="card-description">{{ count($transfers) }} joueurs affichés sur {{ $count }}</code>
        @endif
        </p>
        <div class="table-bordered table-responsive">
          <table class="table">
            <thead>
                <tr>
                  <th> # </th>
                  <th> Joueur [prénom nom (pseudo)] </th>
                  <th> Montant transféré </th>
                  <th> Date du transfer </th>
                  <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transfers as $transfer)
                @php
                  $i++;   
                @endphp
                <tr>
                    <td> {{ $i }} </td>
                    <td> {{ $players[$transfer->user]->firstname . ' ' . $players[$transfer->user]->lastname . ' (' . $players[$transfer->user]->username . ')' }} </td>
                    <td> {{ $transfer->amount . ' €' }} </td>
                    <td> {{ \Carbon\Carbon::parse($transfer->created_at)->format('d/m/Y') }} </td>
                    <td>    
                      <form action="{{ route('transfer.delete', ['id' => $transfer->id]) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce dépôt ? Toute suppression d\'un dépôt est définitive et ce dernier est supprimé de la base de données')" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button href="#" title="Supprimer" type="submit" class="btn btn-outline-danger">
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
        {{ $transfers->links() }}
      </div>
    </div>
  </div>
</div>

<!-- modale -->

@endsection