@extends('layouts.admin')

@section('title', 'Détails du Type de Contenu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails du Type de Contenu : {{ $typeContenu->nom_contenu }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('typecontenus.index') }}" class="btn btn-secondary">
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
                                    <td>{{ $typeContenu->id_type_contenu }}</td>
                                </tr>
                                <tr>
                                    <th>Nom :</th>
                                    <td><strong>{{ $typeContenu->nom_contenu }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Nombre de contenus :</th>
                                    <td>
                                        <span class="badge bg-primary">{{ $typeContenu->contenus->count() }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($typeContenu->contenus->count() > 0)
                    <div class="mt-4">
                        <h5>Contenus associés</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Titre</th>
                                        <th>Région</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($typeContenu->contenus->take(5) as $contenu)
                                    <tr>
                                        <td>{{ $contenu->id_contenu }}</td>
                                        <td>
                                            <a href="{{ route('contenus.show', $contenu) }}">
                                                {{ Str::limit($contenu->titre, 40) }}
                                            </a>
                                        </td>
                                        <td>{{ $contenu->region->nom_region }}</td>
                                        <td>
                                            <span class="badge bg-{{ $contenu->statut == 'publié' ? 'success' : 'warning' }}">
                                                {{ $contenu->statut }}
                                            </span>
                                        </td>
                                        <td>{{ $contenu->date_creation->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($typeContenu->contenus->count() > 5)
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    ... et {{ $typeContenu->contenus->count() - 5 }} autres contenus
                                </small>
                            </div>
                        @endif
                    </div>
                    @endif
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('typecontenus.edit', $typeContenu) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('typecontenus.destroy', $typeContenu) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ? Cette action supprimera tous les contenus associés.')">
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
