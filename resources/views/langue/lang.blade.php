@extends('layouts.lay')

@section('title', 'Langues')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Langues</h3>
                    <div class="card-tools">
                        <a href="{{ route('langues.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouvelle Langue
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
                    
                    <table id="langues-table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Utilisateurs</th>
                                <th>Contenus</th>
                                <th>Régions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Les données seront chargées via AJAX -->
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#langues-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('langues.datatable') }}",
        columns: [
            { data: 'id_langue', name: 'id_langue' },
            { data: 'nom_langue', name: 'nom_langue' },
            { data: 'code_langue', name: 'code_langue' },
            { 
                data: 'description', 
                name: 'description',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return data ? (data.length > 50 ? data.substr(0, 50) + '...' : data) : '-';
                    }
                    return data;
                }
            },
            { 
                data: 'utilisateurs_count', 
                name: 'utilisateurs_count',
                searchable: false,
                orderable: false
            },
            { 
                data: 'contenus_count', 
                name: 'contenus_count',
                searchable: false,
                orderable: false
            },
            { 
                data: 'regions_count', 
                name: 'regions_count',
                searchable: false,
                orderable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="btn-group btn-group-sm">
                            <a href="/admin/langues/${row.id_langue}" class="btn btn-info" title="Voir">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="/admin/langues/${row.id_langue}/edit" class="btn btn-warning" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="/admin/langues/${row.id_langue}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette langue ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    `;
                }
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="bi bi-clipboard"></i> Copier',
                className: 'btn btn-secondary'
            },
            {
                extend: 'csv',
                text: '<i class="bi bi-file-earmark-spreadsheet"></i> CSV',
                className: 'btn btn-info'
            },
            {
                extend: 'excel',
                text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'pdf',
                text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                className: 'btn btn-danger'
            },
            {
                extend: 'print',
                text: '<i class="bi bi-printer"></i> Imprimer',
                className: 'btn btn-dark'
            }
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]]
    });
});
</script>