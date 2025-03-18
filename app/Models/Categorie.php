<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['nom', 'couleur'];

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }
}
