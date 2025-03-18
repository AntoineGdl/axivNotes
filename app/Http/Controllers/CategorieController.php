<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories',
            'couleur' => 'required|string|max:7',
        ]);

        $categorie = Categorie::create($validated);

        return response()->json([
            'success' => true,
            'categorie' => $categorie
        ]);
    }
}
