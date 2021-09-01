<?php 

$page = 'dépôts';
$title = 'Tous les dépots';

$i = 0;

?>

@extends('admin.layout.main')

@section('content')
<div class="row" id="proBanner">
    <div class="col-12">
      <span class="d-flex align-items-center purchase-popup">
        <p></p>       
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
        <h4 class="card-title">dépôts</h4>
        @if (count($depots) == 0)
            <p class="card-description">Aucun dépôt effectué</p>
        @else
            <p class="card-description">{{ count($depots) }} depots bomb affichés sur {{ $count }}</depot>
        @endif
        </p>
        <div class="table-bordered table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> # </th>
                <th> Joueur [prénom nom (pseudo)] </th>
                <th> Montant déposé </th>
                <th> Date du dépot </th>
                <th> Actions </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($depots as $depot)

                @php
                  $i++;   
                @endphp
                
                <tr>
                    <td> {{ $i }} </td>
                    <td> {{ $player[$depot->id]->firstname . ' ' . $player[$depot->id]->lastname . ' (' . $player[$depot->id]->pseudo . ')' }} </td>
                    <td> {{ $depot->amount }}€ </td>
                    <td> {{ \Carbon\Carbon::parse($depot->created_at)->format('d/m/Y') }} </td>
                    <td>    
                      <form action="{{ route('depot.delete', ['id' => $depot->id]) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce dépôt ? Toute suppression d\'un dépôt est définitive et ce dernier est supprimé de la base de données')" method="POST">
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
        {{ $depots->links() }}
      </div>
    </div>
  </div>
</div>

<!-- modale -->

@endsection