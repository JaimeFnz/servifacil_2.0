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
     * Display a listing of the notes, products, and desks
     */
    public function index()
    {
        // Obtener todas las comandas con sus productos, alergenos y la cantidad asociada
        $notes = Comanda::with([
            'mesa',
            'productos' => function ($query) {
                $query->select('productos.*', 'contiene.cantidad as cantidad');
            },
            'productos.alergenos',
            'mesa.camarero'
        ])
            ->whereHas('mesa')
            ->get();

        // Pasar los datos a la vista
        return view('note', compact('notes'));
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
     * Esta función almacena una nueva comanda en la base de datos.
     * 
     * Pasos:
     * 1. Valida los datos de entrada del formulario de la comanda, incluyendo la existencia de los productos y cantidades.
     * 2. Crea una nueva instancia de la comanda en la base de datos.
     * 3. Procesa los productos y cantidades ingresados, guardándolos en la comanda.
     * 4. Redirecciona al usuario a la página de inicio con un mensaje de éxito si la comanda se crea correctamente.
     * 5. Si ocurre algún error durante el proceso, redirecciona al usuario de regreso al formulario de comanda con un mensaje de error.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'desks' => 'required|exists:mesa,id',
                'cant_clientes' => 'required|integer|min:1',
                'drinks.*.id' => 'required|exists:productos,id',
                'drinks.*.cantidad' => 'integer|min:0',
                'picapica.*.id' => 'required|exists:productos,id',
                'picapica.*.cantidad' => 'integer|min:0',
                'primero.*.id' => 'required|exists:productos,id',
                'primero.*.cantidad' => 'integer|min:0',
                'segundo.*.id' => 'required|exists:productos,id',
                'segundo.*.cantidad' => 'integer|min:0',
                'postre.*.id' => 'required|exists:productos,id',
                'postre.*.cantidad' => 'integer|min:0',
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
            $this->saveProductos($note->id, $request->input('drinks'));
            $this->saveProductos($note->id, $request->input('picapica'));
            $this->saveProductos($note->id, $request->input('primero'));
            $this->saveProductos($note->id, $request->input('segundo'));
            $this->saveProductos($note->id, $request->input('postre'));

            // Redireccionar con un mensaje de éxito
            return redirect()->route('home')->with('success', 'Nota creada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'La nota no pudo ser creada: ' . $e->getMessage());
        }
    }

    /**
     * Guarda los productos en la comanda.
     *
     * @param int $noteId
     * @param array $products
     * @return void
     */
    private function saveProductos($noteId, $products)
    {
        foreach ($products as $product) {
            // if ($product['cantidad'] > 0) {
                Contiene::create([
                    'id_comanda' => $noteId,
                    'id_producto' => $product['id'],
                    'cantidad' => $product['cantidad'],
                ]);
            // }
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
