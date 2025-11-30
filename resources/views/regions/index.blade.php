@extends('layouts.admin')

@section('title', 'Régions')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Régions</h3>
                    <div class="card-tools">
                        <a href="{{ route('regions.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouvelle Région
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Population</th>
                                    <th>Superficie</th>
                                    <th>Localisation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($regions as $region)
                                <tr>
                                    <td>{{ $region->id_region }}</td>
                                    <td>
                                        <strong>{{ $region->nom_region }}</strong>
                                        @if($region->description)
                                            <br><small class="text-muted">{{ Str::limit($region->description, 30) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($region->population)
                                            {{ number_format($region->population, 0, ',', ' ') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($region->superficie)
                                            {{ number_format($region->superficie, 0, ',', ' ') }} km²
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $region->localisation ?: '-' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('regions.show', $region) }}" class="btn btn-info" title="Voir">
                                                <i class="bi bi-eye">Voir</i>
                                            </a>
                                            <a href="{{ route('regions.edit', $region) }}" class="btn btn-warning" title="Modifier">
                                                <i class="bi bi-pencil">modifier</i>
                                            </a>
                                            <form action="{{ route('regions.destroy', $region) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette région ?')">
                                                    <i class="bi bi-trash">supprimer</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Aucune région trouvée</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Total : {{ $regions->count() }} région(s)</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection