<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'cod_camarero' => 'required|exists:users,id',
            'cant_clientes' => 'required|integer|min:1',
        ]);

        Mesa::create($validated);

        return back()->with('success', 'Mesa creada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $desk = Mesa::findOrFail($id);
        if ($desk->comandas->isNotEmpty()) {
            foreach ($desk->comandas as $comanda) {
                $comanda->delete();
            }
        }
        $desk->delete();
        return back()->with('success', 'Mesa eliminada exitosamente');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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

}