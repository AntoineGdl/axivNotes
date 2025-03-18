<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une dépense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Ajouter une dépense</h4>
                    <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('depenses.store') }}">
                        @csrf

                        <div class="mb-3 row">
                            <label for="date" class="col-md-4 col-form-label text-md-end">Date</label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                                @error('date')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nom_entreprise" class="col-md-4 col-form-label text-md-end">Nom de l'entreprise</label>
                            <div class="col-md-6">
                                <input id="nom_entreprise" type="text" class="form-control @error('nom_entreprise') is-invalid @enderror" name="nom_entreprise" value="{{ old('nom_entreprise') }}" required>
                                @error('nom_entreprise')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="montant" class="col-md-4 col-form-label text-md-end">Montant HT</label>
                            <div class="col-md-6">
                                <input id="montant" type="number" step="0.01" class="form-control @error('montant') is-invalid @enderror" name="montant" value="{{ old('montant') }}" required>
                                @error('montant')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Après le champ montant et avant le bouton submit -->
                        <div class="mb-3 row">
                            <label class="col-md-4 col-form-label text-md-end">Catégorie</label>
                            <div class="col-md-6">
                                <div class="d-flex gap-2">
                                    <select id="categorie_id" class="form-select @error('categorie_id') is-invalid @enderror" name="categorie_id">
                                        <option value="">Sélectionnez ou créez une catégorie</option>
                                        @if($categories->count() > 0)
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                                    {{ $categorie->nom }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>Aucune catégorie disponible</option>
                                        @endif
                                    </select>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nouvelleCategorieModal">
                                        <i class="bi bi-plus"></i> Nouvelle
                                    </button>
                                </div>
                                @error('categorie_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Modal pour créer une nouvelle catégorie -->
                        <div class="modal fade" id="nouvelleCategorieModal" tabindex="-1" aria-labelledby="nouvelleCategorieModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="nouvelleCategorieModalLabel">Créer une nouvelle catégorie</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nouvelle_categorie" class="form-label">Nom de la catégorie</label>
                                            <input type="text" class="form-control" id="nouvelle_categorie" name="nouvelle_categorie">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nouvelle_couleur" class="form-label">Couleur</label>
                                            <input type="color" class="form-control form-control-color" id="nouvelle_couleur" name="nouvelle_couleur" value="#3498db">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="button" class="btn btn-primary" id="sauvegarderCategorie">Sauvegarder</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('sauvegarderCategorie').addEventListener('click', function() {
            const nom = document.getElementById('nouvelle_categorie').value;
            const couleur = document.getElementById('nouvelle_couleur').value;

            if (!nom) {
                alert('Veuillez saisir un nom de catégorie');
                return;
            }

            // Envoyer la requête AJAX pour créer la catégorie
            fetch('{{ route('categories.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ nom, couleur })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Ajouter la nouvelle catégorie au select et la sélectionner
                        const select = document.getElementById('categorie_id');
                        const option = new Option(data.categorie.nom, data.categorie.id, true, true);
                        select.add(option);

                        // Fermer le modal
                        bootstrap.Modal.getInstance(document.getElementById('nouvelleCategorieModal')).hide();
                    } else {
                        alert(data.message || 'Erreur lors de la création de la catégorie');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue');
                });
        });
    });
</script>
</body>
</html>
