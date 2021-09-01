<?php 

$title = 'Comptes à valider';

$i = 0;

?>

@extends('admin.layout.main')

@section('content')

<div class="row">
  <div class="col-sm-12">
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
        <h4 class="card-title">Comptes à valider</h4>
        @if (count($players) == 0)
            <p class="card-description">Aucun compte à valider</p>
        @else
            <p class="card-description">{{ count($players) }} compte à valider sur {{ $count }}</code>
        @endif
        </p>
        <div class="table-bordered table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> # </th>
                <th> Nom Prénom (pseudo) </th>
                <th> Date de creation de compte </th>
                <th> Pièce d'identité recto </th>
                <th> Pièce d'identité verso </th>
                <th> RIB </th>
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
                    <td> {{ $player->lastname . ' ' . $player->firstname . ' (' . $player->username . ')'}} </td>
                    <td> {{ $player->created_at }} </td>
                    <td>
                    @if ($cards1[$player->id])
                    <img src="{{  asset("assets/images/cards/" . $cards1[$player->id]->image) }}" alt="card1">
                    @else 
                    Aucun
                    @endif
                    </td>
                    <td>
                    @if ($cards2[$player->id])
                    <img src="{{  asset("assets/images/cards/" . $cards2[$player->id]->image) }}" alt="card2">
                    @else 
                    Aucun
                    @endif
                    </td>
                    <td>
                    @if ($rib[$player->id])
                    <img src="{{  asset("assets/images/cards/" . $rib[$player->id]->image) }}" alt="rib">
                    @else 
                    Aucun
                    @endif
                    </td>
                    <td> 
                        <a href="{{ route('player.validate', ['player' => $player->id]) }}"  onclick="return confirm('Êtes-vous sûr de vouloir valider ce compte ?')" title="validate" class="btn btn-outline-success">
                            Valider
                        </a>  
                        <a href="{{ route('player.not.validate', ['player' => $player->id]) }}"  onclick="return confirm('Êtes-vous sûr de vouloir réfuser la valider de ce compte ?')" title="validate" class="btn btn-outline-info">
                            Refuser la validation
                        </a>  
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modale -->

@endsection