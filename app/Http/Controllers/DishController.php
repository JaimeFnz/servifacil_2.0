<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($section)
    
    {
        if ($section) {
            // Filtrar platos por sección del submenú
            $dishes = Dish::where('section', $section)->get();
        } if ($section == "all") {
            // Obtener todos los platos
            $dishes = Dish::all()->sortBy('tipo');
        }
        
        return view('dishes.index', compact('dishes'));
    }

    // public function index()
    // {
    //     return view('dishes.index');
    // }

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
