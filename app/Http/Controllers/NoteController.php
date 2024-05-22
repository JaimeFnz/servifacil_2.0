<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Mesa;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las mesas con sus comandas y productos asociados
        $mesas = Mesa::with(['comandas.productos.alergenos', 'camarero'])->get();

        // Pasar los datos a la vista
        return view('note', compact('mesas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Buscar la comanda por su ID
        $comanda = Comanda::findOrFail($id);
        $comanda->validate($request->all());
        $comanda->update($request->all());

        // Redirigir de vuelta a la página de detalles de la comanda actualizada
        return redirect()->route('comanda.show', $id)->with('success', 'Comanda updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $comanda = Comanda::findOrFail($id);
            $comanda->delete();
            return redirect()->route('comanda.index')->with('success', 'Comanda deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting comanda: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Aquí van las reglas de validación si es necesario
        ]);

        try {
            // Crear una nueva instancia de Comanda con los datos del formulario
            $comanda = new Comanda([
                'id_mesa' => $request->input('id_mesa'),
                // Otros campos para crear si los hay
            ]);

            // Guardar la nueva comanda en la base de datos
            $comanda->save();

            return redirect()->route('comanda.index')->with('success', 'Comanda created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating comanda: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desks = Mesa::all();
        $products = Producto::select('id', 'nombre', 'tipo')->get();
        return view ('mgmt.note.create', compact('desks','products'));
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
}
