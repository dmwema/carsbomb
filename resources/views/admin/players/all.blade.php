<?php 

$page = 'joueurs';
$title = 'Tous  les joueurs';

$i = 0;

$type = ['Joueur réel', 'Joueur fictif'];
$status = [
  ACCOUNT_WAITING => 'En attente de validation', 
  ACCOUNT_REFUSED => 'Refusé', 
  ACCOUNT_VALIDATED => 'Validé'
];

$status_color = 'black'

?>

@extends('admin.layout.main')

@section('content')
<div class="row" id="proBanner">
    <div class="col-12">
      <span class="d-flex align-items-center purchase-popup">
        <p></p>       
        <a href="#" class="btn btn-inverse-primary btn-fw ml-auto"><i class="mdi mdi-plus "></i> Nouveau joueur</a>
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
    @if (Session::has('validated'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ Session::get('validated') }}
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
        @if (count($players) == 0)
            <p class="card-description">Aucun joueur enrégistré</p>
        @else
            <p class="card-description">{{ count($players) }} joueurs affichés sur {{ $count }}</code>
        @endif
        </p>
        <div class="table-bordered table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> # </th>
                <th> Photo </th>
                <th> Noms </th>
                <th> Pièces administratives </th>
                <th> carte de crédit </th>
                <th> pseudo </th>
                <th> email </th>
                <th> Type </th>
                <th> Date de création </th>
                <th> Dernière connexion </th>
                <th> Date de naissance </th>
                <th> Code bomb </th>
                <th> Code de parrainage </th>
                <th> Filleuls </th>
                <th> Parrain </th>
                <th> Boost inscription activé </th>
                <th> Boost parrainage activé  </th>                
                <th> Status </th>
                <th> Dépôts </th>
                <th> Retraits </th>
                <th> Gains </th>
                <th> Pertes </th>
                <th> Solde </th>
                <th> Actions </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($players as $player)

                @php
                  $i++;   
                @endphp
                
                <tr>
                  <td> {{ $i }} </td>
                  @if ($player->image == null) 
                  <td> <img src="{{ asset('assets/images/profile.jpg') }}" alt="{{ $player->pseudo }}"></td>
                  @else
                  <td> <img src="{{ asset('assets/images/players/' . $player->image) }}" alt="{{ $player->pseudo }}"></td>
                  @endif
                  <td> {{ $player->firstname . ' ' . $player->lastname }} </td>
                  <td> AUCUNE </td>
                  <td> 4242 4242 4242 4242 </td>
                  <td> {{ $player->username }} </td>
                  <td> {{ $player->email }} </td>
                  <td> {{ $type[$player->type - 1] }} </td>
                  <td> {{ \Carbon\Carbon::parse($player->created_at)->format('d/m/Y') }} </td>
                  <td> {{ \Carbon\Carbon::parse($player->updated_at)->format('d/m/Y') }} </td>
                  <td> {{ \Carbon\Carbon::parse($player->birthday)->format('d/m/Y') }} </td>
                  <td> {{ $used_codes[$player->id] }} </td>
                  <td> {{ $player->id }} </td>
                  <td> {{ $childs[$player->id] ?? 'Aucun' }} </td>
                  <td> {{ $player->parent }} </td>
                  <td> {{ /*$boot_inscrs[$player->id] ? 'Oui':*/ 'Non'  }} </td>
                  <td> {{ /*boot_parents[$player->id] ? 'Oui':*/ 'Non' }} </td>

                  @php
                      if ($player->status == ACCOUNT_VALIDATED) {
                        $status_color = 'green';
                      } elseif ($player->status == ACCOUNT_REFUSED) {
                        $status_color = 'red';
                      } elseif ($player->status == ACCOUNT_WAITING){
                        $status_color = 'yellow';
                      }
                  @endphp
                  
                  <td style="color: {{ $status_color }} "> {{ $status[$player->status] }} </td>
                  <td> {{ ($depots[$player->id] ?? '0') . ' €' }} </td>
                  <td> {{ ($retraits[$player->id] ?? '0') . ' €' }} </td>
                  <td> {{ ($wins[$player->id] ?? '0') . ' €' }} </td>
                  <td> {{ ($looses[$player->id] ?? '0') . ' €' }} </td>
                  <td> {{ ($soldes[$player->id] ?? '0') . ' €' }} </td>
                  <td>    
                    <div class="btn-group" role="group" aria-label="Basic example">
                    <form action="{{ route('player.delete', ['id' => $player->id]) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur ? Toute suppression d\'un joueur est définitive et cette dernière est supprimée de la base de données')" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      @csrf
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button href="#" title="Supprimer" type="submit" class="btn btn-outline-danger">
                          <i class="mdi mdi-delete "></i>
                        </button>
                      </div>
                    </form>
                    @if ($player->status == ACCOUNT_WAITING)
                      <a href="{{ route('player.validate', ['player' => $player->id]) }}"  onclick="return confirm('Êtes-vous sûr de vouloir valider ce compte ?')" title="validate" class="btn btn-outline-success">
                        Valider
                      </a>  
                      <a href="{{ route('player.not.validate', ['player' => $player->id]) }}"  onclick="return confirm('Êtes-vous sûr de vouloir réfuser la valider de ce compte ?')" title="validate" class="btn btn-outline-info">
                        Refuser la validation
                      </a>  
                    @endif
                    </div>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        {{ $players->links() }}
      </div>
    </div>
  </div>
</div>

<!-- modale -->

@endsection