<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Contiene;
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
        // Validar los datos de entrada
        $request->validate([
            'desks' => 'required|exists:mesa,id',
            'cant_clientes' => 'required|integer|min:1',
            'drinks.*.id' => 'required|exists:productos,id',
            'drinks.*.cantidad' => 'required|integer',
            'picapica.*.id' => 'required|exists:productos,id',
            'picapica.*.cantidad' => 'required|integer',
            'primero.*.id' => 'required|exists:productos,id',
            'primero.*.cantidad' => 'required|integer',
            'segundo.*.id' => 'required|exists:productos,id',
            'segundo.*.cantidad' => 'required|integer',
            'postre.*.id' => 'required|exists:productos,id',
            'postre.*.cantidad' => 'required|integer',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'exists' => 'El :attribute seleccionado no existe en la base de datos.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'min' => 'El campo :attribute debe ser como mínimo :min.',
        ]);

        // Crear una nueva comanda
        $comanda = Comanda::create([
            'id_mesa' => $request->input('desks'),
        ]);

        // Procesar los productos y cantidades
        $this->saveProductos($comanda->id, $request->input('drinks'));
        $this->saveProductos($comanda->id, $request->input('picapica'));
        $this->saveProductos($comanda->id, $request->input('primero'));
        $this->saveProductos($comanda->id, $request->input('segundo'));
        $this->saveProductos($comanda->id, $request->input('postre'));

        // Redireccionar con un mensaje de éxito
        return back()->with('status', 'Comanda creada exitosamente');
    }

    private function saveProductos($comandaId, $productos)
    {
        foreach ($productos as $producto) {
            Contiene::create([
                'id_comanda' => $comandaId,
                'id_producto' => $producto['id'],
                'cantidad' => $producto['cantidad'],
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desks = Mesa::all();
        $products = Producto::select('id', 'nombre', 'tipo')->get();
        return view('mgmt.note.create', compact('desks', 'products'));
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
        $info = Contiene::where('id', $id)->get();
        $info[] = Producto::where('id', $info->id)->get();

        return view('note.edit', compact('info'));
    }
}
    