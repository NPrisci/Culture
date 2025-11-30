<div class="btn-group btn-group-sm">
    <a href="{{ route('langues.show', $langue) }}" class="btn btn-info" title="Voir">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ route('langues.edit', $langue) }}" class="btn btn-warning" title="Modifier">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ route('langues.destroy', $langue) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette langue ?')">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>