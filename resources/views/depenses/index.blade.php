<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des dépenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Liste des dépenses</h4>
                    <a href="{{ route('depenses.create') }}" class="btn btn-success">Ajouter une dépense</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Entreprise</th>
                                <th>Description</th>
                                <th>Montant HT (€)</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($depenses as $depense)
                                <tr>
                                    <td>{{ $depense->date->format('d/m/Y') }}</td>
                                    <td>{{ $depense->nom_entreprise }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($depense->description, 30) }}</td>
                                    <td>{{ number_format($depense->montant, 2, ',', ' ') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('depenses.edit', $depense) }}" class="btn btn-sm btn-warning">Modifier</a>
                                            <form action="{{ route('depenses.destroy', $depense) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette dépense?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune dépense trouvée</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $depenses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
