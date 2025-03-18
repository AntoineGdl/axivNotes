<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $fillable = [
        'date',
        'nom_entreprise',
        'description',
        'montant',
        'categorie_id'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
