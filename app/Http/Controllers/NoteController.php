<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
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
        $note = Comanda::findOrFail($id);
        $note->validate($request->all());
        $note->update($request->all());

        // Redirigir de vuelta a la página de detalles de la note actualizada
        return redirect()->route('note-mgmt.index', $id)->with('success', 'note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $comanda = Comanda::findOrFail($id);
            $comanda->productos()->detach();
            $comanda->delete();

            return back()->with('success', 'Comanda eliminada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la comanda: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
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
            $note = Comanda::create([
                'id_mesa' => $request->input('desks'),
            ]);

            // Procesar los productos y cantidades
            $this->saveProductos($note->id, $request->input('bebida'));
            $this->saveProductos($note->id, $request->input('picapica'));
            $this->saveProductos($note->id, $request->input('primero'));
            $this->saveProductos($note->id, $request->input('segundo'));
            $this->saveProductos($note->id, $request->input('postre'));

            // Redireccionar con un mensaje de éxito
            return back()->with('status', 'Note creada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'La nota no puedo ser creda: '. $e);
        }
    }

    private function saveProductos($noteID, $products)
    {
        foreach ($products as $product) {
            Contiene::create([
                'id_comanda' => $noteID,
                'id_producto' => $product['id'],
                'cantidad' => $product['cantidad'],
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
    public function edit($id)
    {
        try {
            // Obtener la comanda con sus relaciones
            $note = Comanda::with('productos.alergenos')->findOrFail($id);

            return view('mgmt.note.edit', compact('note'));
        } catch (\Exception $e) {
            return redirect('error')->with('error', 'Error al editar la comanda: ' . $e->getMessage());
        }
    }



}
