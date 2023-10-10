<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredient = Ingredient::select('id','name')->get();

        return response()->json($ingredient, 200);
    }
}
