<?php 

$page = 'codes bomb';
$title = 'Tous les codes bomb';

$i = 0;

?>

@extends('admin.layout.main')

@section('content')
<div class="row" id="proBanner">
    <div class="col-12">
      <span class="d-flex align-items-center purchase-popup">
        <p></p>       
        <a href="{{ route('code.new') }}" class="btn btn-inverse-primary btn-fw ml-auto"><i class="mdi mdi-plus "></i> Nouveau code bomb </a>
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
        <h4 class="card-title">Code bombs</h4>
        @if (count($codes) == 0)
            <p class="card-description">Aucun code bomb créé</p>
        @else
            <p class="card-description">{{ count($codes) }} codes bomb affichés sur {{ $count }}</code>
        @endif
        </p>
        <div class="table-bordered table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> # </th>
                <th> Code </th>
                <th> Valeur du gain </th>
                <th> Date de création </th>
                <th> Date de dernière modification </th>
                <th> Date d'expiration </th>
                <th> Etat </th>
                <th> Actions </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($codes as $code)

                @php
                  $i++;   
                @endphp
                
                <tr>
                    <td> {{ $i }} </td>
                    <td> {{ $code->code }} </td>
                    <td> {{ $code->value . ' %' }} </td>
                    <td> {{ \Carbon\Carbon::parse($code->created_at)->format('d/m/Y') }} </td>
                    <td> {{ \Carbon\Carbon::parse($code->updated_at)->format('d/m/Y') }} </td>
                    <td> {{ \Carbon\Carbon::parse($code->end)->format('d/m/Y') }} </td>
                    @if (\Carbon\Carbon::createFromDate($code->end)->gte(Carbon\Carbon::now()))
                        <td> <b class="text-success">En cours</b> </td>
                    @else    
                        <td> <b class="text-danger">Expiré</b> </td>
                    @endif
                    <td>    
                      <form action="{{ route('code.delete', ['id' => $code->id]) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce codebomb ? Toute suppression d\'un codebomb est définitive et ce dernier est supprimé de la base de données')" method="POST">
                      <input type="hidden" name="_method" value="DELETE">
                      @csrf
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('code.edit', ['id' => $code->id]) }}" title="Modifier" type="button" class="btn btn-outline-primary">
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
        {{ $codes->links() }}
      </div>
    </div>
  </div>
</div>

<!-- modale -->

@endsection