<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'nom_entreprise',
        'description',
        'montant',
        'category_id'
    ];

    protected $casts = [
        'date' => 'date',
        'montant' => 'decimal:2',
    ];
}
