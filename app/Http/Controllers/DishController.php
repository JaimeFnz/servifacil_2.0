<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($section)
    {
        // Comprobar si $section tiene algún valor
        if ($section) {
            if ($section == "all") {
                // Obtener todos los platos
                $dishes = Producto::all()->sortBy('tipo');
            } else {
                // Filtrar platos por sección del submenú
                $dishes = Producto::where('tipo', $section)->get();
            }
        } else {
            // Si $section no tiene valor, obtener todos los platos por defecto
            $dishes = Producto::all()->sortBy('tipo');
        }

        // Recoger información sobre alérgenos para cada plato
        foreach ($dishes as $dish) {
            // Obtener los alérgenos asociados al plato
            $alergenos = $dish->alergenos()->pluck('nombre')->toArray();

            // Asignar los alérgenos al plato
            $dish->alergenos = $alergenos;
        }

        return view('dishes', compact('dishes'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
