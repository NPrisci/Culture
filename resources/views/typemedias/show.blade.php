@extends('layouts.admin')

@section('title', 'Détails du Type de Média')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails du Type de Média : {{ $typeMedia->nom_media }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('typemedias.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">ID :</th>
                                    <td>{{ $typeMedia->id_type_media }}</td>
                                </tr>
                                <tr>
                                    <th>Nom :</th>
                                    <td><strong>{{ $typeMedia->nom_media }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Nombre de médias :</th>
                                    <td>
                                        <span class="badge bg-primary">{{ $typeMedia->medias->count() }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($typeMedia->medias->count() > 0)
                    <div class="mt-4">
                        <h5>Médias associés</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Chemin</th>
                                        <th>Contenu</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($typeMedia->medias->take(5) as $media)
                                    <tr>
                                        <td>{{ $media->id_media }}</td>
                                        <td>
                                            <code>{{ Str::limit($media->chemin, 30) }}</code>
                                        </td>
                                        <td>
                                            @if($media->contenu)
                                                <a href="{{ route('contenus.show', $media->contenu) }}">
                                                    {{ Str::limit($media->contenu->titre, 30) }}
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($media->description, 30) ?: '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($typeMedia->medias->count() > 5)
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    ... et {{ $typeMedia->medias->count() - 5 }} autres médias
                                </small>
                            </div>
                        @endif
                    </div>
                    @endif
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('typemedias.edit', $typeMedia) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('typemedias.destroy', $typeMedia) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ? Cette action supprimera tous les médias associés.')">
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