@extends('layouts.admin')

@section('title', 'Détails de la Langue')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails de la Langue</h3>
                    <div class="card-tools">
                        <a href="{{ route('langues.index') }}" class="btn btn-secondary">
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
                                    <td>{{ $langue->id_langue }}</td>
                                </tr>
                                <tr>
                                    <th>Nom :</th>
                                    <td>{{ $langue->nom_langue }}</td>
                                </tr>
                                <tr>
                                    <th>Code :</th>
                                    <td><span class="badge bg-primary">{{ $langue->code_langue }}</span></td>
                                </tr>
                                <tr>
                                    <th>Description :</th>
                                    <td>{{ $langue->description ?? 'Aucune description' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('langues.edit', $langue->id_langue) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('langues.destroy', $langue->id_langue) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette langue ?')">
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