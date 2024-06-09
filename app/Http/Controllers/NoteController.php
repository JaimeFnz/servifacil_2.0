<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
use App\Models\Comanda;
use App\Models\Contiene;
use App\Models\Mesa;
use Illuminate\Support\Facades\Log;
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

        // Calcular el total por comanda
        $notes->each(function ($note) {
            $note->totalCost = $note->productos->sum(function ($producto) {
                return $producto->precio * $producto->pivot->cantidad;
            });
        });

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
            $validatedData = $request->validate([
                'desks' => 'required|exists:mesa,id',
                'cant_clientes' => 'required|integer|min:1',
                'bebida.*.id' => 'nullable|exists:productos,id',
                'bebida.*.cantidad' => 'nullable|integer|min:0',
                'picapica.*.id' => 'nullable|exists:productos,id',
                'picapica.*.cantidad' => 'nullable|integer|min:0',
                'primero.*.id' => 'nullable|exists:productos,id',
                'primero.*.cantidad' => 'nullable|integer|min:0',
                'segundo.*.id' => 'nullable|exists:productos,id',
                'segundo.*.cantidad' => 'nullable|integer|min:0',
                'postre.*.id' => 'nullable|exists:productos,id',
                'postre.*.cantidad' => 'nullable|integer|min:0',
            ]);

            // Crear una nueva comanda
            $note = Comanda::create([
                'id_mesa' => $validatedData['desks'],
            ]);

            // Procesar los productos y cantidades
            foreach (['bebida', 'picapica', 'primero', 'segundo', 'postre'] as $tipo) {
                if (isset($validatedData[$tipo])) {
                    $this->saveProductos($note->id, $validatedData[$tipo], $tipo);
                    Log::info('Guardando productos: ' . $tipo, [$tipo => $validatedData[$tipo]]);
                }
            }

            // Redireccionar con un mensaje de éxito
            return redirect()->route('home')->with('success', 'Nota creada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al crear la nota: ' . $e->getMessage());
            return back()->with('error', 'La nota no pudo ser creada: ' . $e->getMessage());
        }
    }

    /**
     * Guarda los productos en la comanda.
     *
     * @param int $noteId
     * @param array $products
     * @param string $tipo
     * @return void
     */
    private function saveProductos($noteId, $products, $tipo)
    {
        foreach ($products as $product) {
            try {
                // Verificar que el producto es del tipo correcto
                if ($producto = Producto::find($product['id'])) {
                    if ($producto->tipo === $tipo && $product['cantidad'] > 0) {
                        Contiene::create([
                            'id_comanda' => $noteId,
                            'id_producto' => $product['id'],
                            'cantidad' => $product['cantidad'],
                        ]);
                        Log::info('Producto guardado correctamente.', ['noteId' => $noteId, 'product' => $product]);
                    } else {
                        Log::warning('El producto no coincide con el tipo esperado o la cantidad no es válida.', ['noteId' => $noteId, 'product' => $product, 'expected' => $tipo]);
                    }
                } else {
                    Log::warning('El producto no existe.', ['noteId' => $noteId, 'product' => $product]);
                }
            } catch (\Exception $e) {
                Log::error('Error al guardar el producto: ' . $e->getMessage(), ['noteId' => $noteId, 'product' => $product]);
            }
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
