<?php

namespace App\Http\Controllers;

use App\Models\Etape;
use App\Models\Ingredient;
use App\Models\IngredientOfPlat;
use App\Models\Plat;
use App\Models\Unite;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plat = Plat::orderBy('importance_id')->get();

        foreach ($plat as $item) {
            if($item->preparation_time > '01:00:00') {
                $item->preparation_time = Carbon::parse($item->preparation_time)->isoFormat('HH:mm');
            } else {
                $item->preparation_time = Carbon::parse($item->preparation_time)->isoFormat('mm');
            }
        }

        return response()->json($plat, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Plat $plat, Request $request, IngredientOfPlat $ingredientOfPlat, Etape $etape, Unite $unite)
    {
        $once = $plat->where('slug', $request->slug)->first();

        if($once->cooking_time > '01:00:00') {
            $once->cooking_time = Carbon::parse($once->cooking_time)->isoFormat('HH:mm');
        } else {
            $once->cooking_time = Carbon::parse($once->cooking_time)->isoFormat('mm');
        }

        if($once->preparation_time > '01:00:00') {
            $once->preparation_time = Carbon::parse($once->preparation_time)->isoFormat('HH:mm');
        } else {
            $once->preparation_time = Carbon::parse($once->preparation_time)->isoFormat('mm');
        }

        $platId = $once->id;

        $ingredient = $ingredientOfPlat->with('ingredient')->where('plat_id', $platId)->get();

        foreach ($ingredient as $item) {
            $item->ingredient->unité_id = $unite->where('id', $item->ingredient->unité_id)->first()->symbole;
        }



        $etapes = $etape->where('plat_id', $platId)->orderBy('order')->get();


        return response()->json([
            'plat' => $once,
            'ingredient' => $ingredient,
            'etapes' => $etapes
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plat $plat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plat $plat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plat $plat)
    {
        //
    }

    public function filter(Request $request) {

        $mergedPlats = collect();

        $plats = null;

        // Filtre d'importance
        if($request->importance != null) {
            foreach ($request->importance as $item) {
                $plats = Plat::where('importance_id', $item)->orderBy('importance_id')->get();
                foreach ($plats as $plat) {
                    $plat->preparation_time = Carbon::parse($plat->preparation_time)->isoFormat('HH:mm');
                }
            }
        }

        // filtre de type
        if ($request->type != null && $plats != null) {
            $plats = $plats->where('type_id', $request->type);
        } elseif ($request->type != null && $plats == null) {
            $plats = Plat::where('type_id', $request->type)->orderBy('importance_id')->get();
            foreach ($plats as $plat) {
                $plat->preparation_time = Carbon::parse($plat->preparation_time)->isoFormat('HH:mm');
            }
        }

        // filtre de temps de préparation
        if ($request->preparation_time != null && $plats != null) {
            $minute = $request->preparation_time;
            $timer = Carbon::createFromTime(0, $minute)->isoFormat('HH:mm');
            $plats = $plats->where('preparation_time','<=', $timer);
        } elseif($request->preparation_time != null && $plats == null){
            $minute = $request->preparation_time;
            $timer = Carbon::createFromTime(0, $minute)->isoFormat('HH:mm');
            $plats = Plat::where('preparation_time','<=', $timer);
        }

        // filtre d'ingrédient
        if ($request->ingredient != null && $plats != null) {
            $ingredientNumber = [];

            foreach ($request->ingredient as $item) {
                $ingredientMatches = Ingredient::where('name', 'LIKE', "$item%")->pluck('id');
                foreach ($ingredientMatches as $number) {
                    array_push($ingredientNumber, $number);
                }
            }

//dump($ingredientNumber);
            foreach ($plats as $plat) {
                $ingredientIdArray = [];
                $ingredientOf = IngredientOfPlat::where('plat_id', $plat->id)->get();

                foreach ($ingredientOf as $ingredient) {
                    array_push($ingredientIdArray, $ingredient->ingredient_id);
                }
//                dump($ingredientIdArray);
                $diff = array_diff($ingredientNumber, $ingredientIdArray);
                if(!empty($diff)) {
//                    dump(array_diff($ingredientNumber, $ingredientIdArray));
//                    dump('ils ne sont pas tous la');
//                    dump($plat->id);
                    $plats = $plats->where('id', '!=',$plat->id);
                }
            }

        } elseif ($request->ingredient != null && $plats == null) {
            $plats = collect();
            $ingredientNumber = [];

            foreach ($request->ingredient as $item) {
                $ingredientMatches = Ingredient::where('name', 'LIKE', "$item%")->pluck('id');
                foreach ($ingredientMatches as $number) {
                    array_push($ingredientNumber, $number);
                }

                $platsWithIngredient = IngredientOfPlat::whereIn('ingredient_id', $ingredientMatches)
                    ->with('plats')
                    ->get();

                if ($platsWithIngredient->isNotEmpty()) {
                    foreach ($platsWithIngredient as $once) {
                        $allRecip = IngredientOfPlat::where('plat_id', $once->plat_id)->get();
//                        dump($allRecip);
                    }
                    $plats = $plats->merge($platsWithIngredient->pluck('plats')->flatten()->unique());
                    $plats = $plats->unique();
                }
            }
//            dump($ingredientNumber);

            foreach ($plats as $plat) {
                $ingredientIdArray = [];
                $ingredientOf = IngredientOfPlat::where('plat_id', $plat->id)->get();

                foreach ($ingredientOf as $ingredient) {
                    array_push($ingredientIdArray, $ingredient->ingredient_id);
                }
//                dump($ingredientIdArray);
                $diff = array_diff($ingredientNumber, $ingredientIdArray);
                if(!empty($diff)) {
//                    dump(array_diff($ingredientNumber, $ingredientIdArray));
//                    dump(count($ingredientNumber));
//                    dump('ils ne sont pas tous la');
//                    dump($plat->id);
                    $plats = $plats->where('id', !$plat->id);
                }
            }

        }

        // collection final
        if($plats != null) {
            foreach ($plats as $plat) {
                if ($plat->preparation_time > '01:00:00') {
                    $plat->preparation_time = Carbon::parse($plat->preparation_time)->isoFormat('HH:mm');
                } else {
                    $plat->preparation_time = Carbon::parse($plat->preparation_time)->isoFormat('mm');
                }
            }
            $mergedPlats = $mergedPlats->merge($plats);

        } else {
            $mergedPlats = Plat::orderBy('importance_id')->get();
            foreach ($mergedPlats as $item) {
                if($item->preparation_time > '01:00:00') {
                    $item->preparation_time = Carbon::parse($item->preparation_time)->isoFormat('HH:mm');
                } else {
                    $item->preparation_time = Carbon::parse($item->preparation_time)->isoFormat('mm');
                }
            }
        }
//dd($mergedPlats);
        return response()->json($mergedPlats, 200);
    }
}
