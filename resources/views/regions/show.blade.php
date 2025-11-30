@extends('layouts.admin')

@section('title', 'Détails de la Région')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails de la Région</h3>
                    <div class="card-tools">
                        <a href="{{ route('regions.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour à la liste
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">ID :</th>
                                    <td>{{ $region->id_region }}</td>
                                </tr>
                                <tr>
                                    <th>Nom :</th>
                                    <td>{{ $region->nom_region }}</td>
                                </tr>
                                <tr>
                                    <th>Description :</th>
                                    <td>{{ $region->description ?? 'Aucune description' }}</td>
                                </tr>
                                <tr>
                                    <th>Population :</th>
                                    <td>{{ $region->population ? number_format($region->population, 0, ',', ' ') : 'Non spécifiée' }}</td>
                                </tr>
                                <tr>
                                    <th>Superficie :</th>
                                    <td>{{ $region->superficie ? number_format($region->superficie, 0, ',', ' ') . ' km²' : 'Non spécifiée' }}</td>
                                </tr>
                                <tr>
                                    <th>Localisation :</th>
                                    <td>{{ $region->localisation ?? 'Non spécifiée' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('regions.edit', $region->id_region) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('regions.destroy', $region->id_region) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette région ?')">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection