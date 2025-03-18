<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une dépense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Modifier la dépense</h4>
                    <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('depenses.update', $depense) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date"
                                   value="{{ old('date', $depense->date->format('Y-m-d')) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nom_entreprise" class="form-label">Nom Entreprise</label>
                            <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise"
                                   value="{{ old('nom_entreprise', $depense->nom_entreprise) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $depense->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant HT (€)</label>
                            <input type="number" step="0.01" class="form-control" id="montant" name="montant"
                                   value="{{ old('montant', $depense->montant) }}" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
