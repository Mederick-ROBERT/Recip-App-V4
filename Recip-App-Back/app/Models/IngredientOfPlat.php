<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientOfPlat extends Model
{
    use HasFactory;

    protected $fillable = [
        'plat_id',
        'ingredient_id',
        'quantity',
    ];

    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }

    public function plats() {
        return $this->belongsTo(Plat::class, 'plat_id');
    }
}
