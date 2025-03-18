<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des dépenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Liste des dépenses</h4>
                    <a href="{{ route('depenses.create') }}" class="btn btn-success">Ajouter une dépense</a>
                        <a href="{{ route('depenses.export', request()->query()) }}" class="btn btn-info me-2">
                            <i class="bi bi-file-earmark-excel"></i> Exporter Excel
                        </a>
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
                                <th>
                                    <div class="d-flex align-items-center">
                                        Date
                                        <a href="{{ route('depenses.index', ['sort' => request('sort') == 'date' && request('direction') != 'desc' ? 'date&direction=desc' : 'date']) }}" class="ms-2 btn btn-sm btn-outline-secondary">
                                            @if(request('sort') == 'date')
                                                <i class="bi bi-sort-{{ request('direction') == 'desc' ? 'down' : 'up' }}"></i>
                                            @else
                                                <i class="bi bi-filter"></i>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th>Entreprise</th>
                                <th>Description</th>
                                <th>Montant HT (€)</th>
                                <th>
                                    <div class="d-flex align-items-center">
                                        Catégorie
                                        <a href="{{ route('depenses.index', ['sort' => request('sort') == 'categorie' && request('direction') != 'desc' ? 'categorie&direction=desc' : 'categorie']) }}" class="ms-2 btn btn-sm btn-outline-secondary">
                                            @if(request('sort') == 'categorie')
                                                <i class="bi bi-sort-{{ request('direction') == 'desc' ? 'down' : 'up' }}"></i>
                                            @else
                                                <i class="bi bi-filter"></i>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $currentMonth = null;
                            @endphp
                            @forelse($depenses as $depense)
                                @php
                                    $month = $depense->date->format('Y-m');
                                @endphp

                                @if($currentMonth !== $month)
                                    <tr>
                                        <td colspan="6" class="bg-light fw-bold py-2" style="border-top: 2px solid #dee2e6;">
                                            {{ $depense->date->format('F Y') }}
                                        </td>
                                    </tr>
                                    @php
                                        $currentMonth = $month;
                                    @endphp
                                @endif

                                <tr>
                                    <td>{{ $depense->date->format('d/m/Y') }}</td>
                                    <td>{{ $depense->nom_entreprise }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($depense->description, 30) }}</td>
                                    <td>{{ number_format($depense->montant, 2, ',', ' ') }}</td>
                                    <td>
                <span class="badge" style="background-color: {{ $depense->categorie->couleur }}; color: #fff;">
                    {{ $depense->categorie->nom }}
                </span>
                                    </td>
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
                                    <td colspan="6" class="text-center">Aucune dépense trouvée</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Table -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>Résumé des dépenses</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Mois</th>
                        <th class="text-end">Total (€)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monthlyTotals as $monthData)
                        <tr>
                            <td>{{ $monthData['month'] }}</td>
                            <td class="text-end">{{ number_format($monthData['total'], 2, ',', ' ') }} €</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr class="fw-bold">
                        <td>Total général</td>
                        <td class="text-end">{{ number_format($grandTotal, 2, ',', ' ') }} €</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
