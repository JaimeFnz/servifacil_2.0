<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
use App\Models\Plato;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * Takes the products of the database, depending on the
     * section selected, after that it adds the alergens.
     */
    public function index(string $section)
    {
        // Verifica si se proporciona un tipo de sección
        if ($section) {
            // Si la sección es "all", obtén todos los platos sin filtrar
            if ($section == "all") {
                $dishes = Producto::with('alergenos')->orderBy('tipo')->get();
            } else {
                // Si se proporciona un tipo de sección específico, filtra los platos por ese tipo
                $dishes = Producto::with('alergenos')->where('tipo', $section)->get();
            }
        } else {
            // Si no se proporciona ningún tipo de sección, obtén todos los platos sin filtrar
            $dishes = Producto::with('alergenos')->orderBy('tipo')->get();
        }

        return view('dishes', compact('dishes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $main = Plato::where('id', $id)->pluck('tiempo')->first();
        $dish = Producto::where('id', $id)->get()->first();
        $dish->main = $main;

        // return dd($dish);
        return view('dish', compact('dish'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alergies = Alergeno::all();

        return view('mgmt.dish.create', compact('alergies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'imagen' => 'image|nullable',
            'tipo' => 'required|in:primero,segundo,postre,picapica,bebida',
            'alergenos' => 'array|nullable',
        ]);

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('images', 'public');
            $validated['imagen'] = $imagePath;
        } else {
            $validated['imagen'] = 'stock.png';
        }

        $plato = Producto::create($validated);

        if ($request->has('alergenos')) {
            $plato->alergenos()->attach($request->alergenos);
        }

        return back()->with('success', 'Plato creado exitosamente');
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

    // Función privada para obtener los alérgenos de un plato
    private function getAlergenos($dish)
    {
        // Obtener los alérgenos asociados al plato
        $alergenos = $dish->alergenos()->pluck('nombre')->toArray();

        return $alergenos;
    }
}
