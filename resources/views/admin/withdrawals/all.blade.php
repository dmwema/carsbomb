<?php 

$page = 'Demandes de retrait';
$title = 'Toutes les demandes de retrait';
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
        <h4 class="card-title">Demandes de retrait</h4>
        @if (count($withdrawals) == 0)
            <p class="card-description">Aucune demande de retrait</p>
        @else
            <p class="card-description">{{ count($withdrawals) }} demandes affichés sur {{ $count }}</p>
        @endif
        </p>
        <div class="table-bordered table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> # </th>
                <th> Joueur [prénom nom (pseudo)] </th>
                <th> Montant démandé </th>
                <th> Date de la demande </th>
                <th> Etat </th>
                <th> Actions </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($withdrawals as $withdrawal)

                @php
                  $i++;   
                @endphp
                
                <tr>
                    <td> {{ $i }} </td>
                    <td> {{ $players[$withdrawal->id]->firstname . ' ' . $players[$withdrawal->id]->lastname . ' (' . $players[$withdrawal->id]->username .')' }} </td>
                    <td> {{ $withdrawal->amount . ' €' }} </td>
                    <td> {{ \Carbon\Carbon::parse($withdrawal->created_at)->format('d/m/Y') }} </td>
                    <td> <b class="text-success">En cours</b> </td>
                    <td>    
                      <form action="{{ route('withdrawal.delete', ['id' => $withdrawal->id]) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande de retrait ? Toute suppression d\'une demande de retrait est définitive et cette dernière est supprimée de la base de données')" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button href="#" title="Supprimer" type="submit" class="btn btn-outline-danger">
                            <i class="mdi mdi-delete "></i>
                          </button>
                          <button href="#" title="Supprimer" type="submit" class="btn btn-outline-success">
                            <i class="mdi mdi-coins "></i>
                              Transferer
                          </button>
                        </div>
                      </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        @if ($withdrawals != null)
        {{ $withdrawals->links() }}
        @endif  
      </div>
    </div>
  </div>
</div>

<!-- modale -->

@endsection