<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class CookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Select only the necessary information of the tables
        $mesas = Mesa::with([
            'comandas' => function ($query) {
                // Select the necessary columns of "comandas"
                $query->select('id', 'id_mesa');
            },
            'comandas.productos' => function ($query) {
                // Select the necessary columns of "productos"
                $query->select('productos.id', 'nombre', 'precio', 'tipo'); // Necesitamos 'productos.id' para las relaciones
            }
        ])->get(['id']);

        // Add the allergens to each one of the products
        foreach ($mesas as $mesa) {
            foreach ($mesa->comandas as $comanda) {
                foreach ($comanda->productos as $producto) {
                    $producto->alergenos = $producto->alergenos()->pluck('nombre')->toArray();
                }

                // Ordenar productos por tipo
                $comanda->productos = $comanda->productos->sortBy('tipo')->values();
            }
        }

        return view('cook', compact('mesas'));
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
