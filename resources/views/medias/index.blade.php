  @extends('layouts.admin')

@section('title', 'Médias')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Médias</h3>
                    <div class="card-tools">
                        <a href="{{ route('medias.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouveau Média
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
                                    <th>Chemin</th>
                                    <th>Description</th>
                                    <th>Contenu</th>
                                    <th>Type Média</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($medias as $media)
                                <tr>
                                    <td>{{ $media->id_media }}</td>
                                    <td>
                                        <code>{{ Str::limit($media->chemin, 30) }}</code>
                                        @if(Str::contains($media->chemin, ['.jpg', '.png', '.gif', '.jpeg']))
                                            <br>
                                            <small class="text-success">
                                                <i class="bi bi-image"></i> Image
                                            </small>
                                        @elseif(Str::contains($media->chemin, ['.mp4', '.avi', '.mov']))
                                            <br>
                                            <small class="text-primary">
                                                <i class="bi bi-camera-video"></i> Vidéo
                                            </small>
                                        @elseif(Str::contains($media->chemin, ['.mp3', '.wav']))
                                            <br>
                                            <small class="text-warning">
                                                <i class="bi bi-music-note"></i> Audio
                                            </small>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($media->description, 40) ?: '-' }}</td>
                                    <td>
                                        @if($media->contenu)
                                            <span class="badge bg-secondary">{{ Str::limit($media->contenu->titre, 20) }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $media->typeMedia->nom_media }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('medias.show', $media) }}" class="btn btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('medias.edit', $media) }}" class="btn btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('medias.destroy', $media) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce média ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Aucun média trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Total : {{ $medias->count() }} média(s)</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection