<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function index()
    {
        $depenses = Depense::latest()->paginate(10);
        return view('depenses.index', compact('depenses'));
    }

    public function create()
    {
        return view('depenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'nom_entreprise' => 'required|string|max:255',
            'description' => 'required|string',
            'montant' => 'required|numeric|min:0',
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
        return view('depenses.edit', compact('depense'));
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
