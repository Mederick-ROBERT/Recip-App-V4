<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Unite;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredient = Ingredient::select('id','name', 'unité_id')->get();

        foreach ($ingredient as $item) {
            $item->unité_id = Unite::where('id', $item->unité_id)->first()->symbole;
        }

        return response()->json($ingredient, 200);
    }
}
