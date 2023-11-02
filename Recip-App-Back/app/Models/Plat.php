<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'importance_id',
        'name',
        'slug',
        'preparation_time',
        'cooking_time',
        'person_number',
        'picture_url'
        ];
}
