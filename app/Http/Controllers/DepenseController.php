<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort');
        $direction = $request->query('direction', 'asc');

        $depensesQuery = Depense::query();

        if ($sort === 'categorie') {
            $depensesQuery->join('categories', 'depenses.categorie_id', '=', 'categories.id')
                ->orderBy('categories.nom', $direction)
                ->select('depenses.*');
        } elseif ($sort === 'date') {
            $depensesQuery->orderBy('date', $direction);
        } else {
            $depensesQuery->orderBy('date', 'desc');
        }

        $depenses = $depensesQuery->get();
        $categories = Categorie::orderBy('nom')->get();

        return view('depenses.index', compact('depenses', 'categories'));
    }

    public function create()
    {
        $categories = Categorie::orderBy('nom')->get();
        return view('depenses.create', compact('categories'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'nom_entreprise' => 'required|string|max:255',
            'description' => 'required|string',
            'montant' => 'required|numeric|min:0',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        Depense::create($validated);

        return redirect()->route('depenses.index')->with('success', 'Dépense ajoutée avec succès.');
    }

    public function show(Depense $depense)
    {
        return view('depenses.show', compact('depense'));
    }

    public function edit(Depense $depense)
    {
        $categories = Categorie::orderBy('nom')->get();
        return view('depenses.edit', compact('depense', 'categories'));
    }

    public function update(Request $request, Depense $depense)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'nom_entreprise' => 'required|string|max:255',
            'description' => 'required|string',
            'montant' => 'required|numeric|min:0',
        ]);

        $depense->update($validated);

        return redirect()->route('depenses.index')->with('success', 'Dépense mise à jour avec succès.');
    }

    public function destroy(Depense $depense)
    {
        $depense->delete();

        return redirect()->route('depenses.index')->with('success', 'Dépense supprimée avec succès.');
    }
}
