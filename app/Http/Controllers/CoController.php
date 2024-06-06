<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;

class CoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     * Aditionally it changes the rol to boss of that company
     * to whoever the admin selects
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'jefe_empresa' => 'required|exists:users,id',
        ]);

        $company = new Empresa();
        $company->name = $request->input('nombre_empresa');
        $company->jefe_id = $request->input('jefe_empresa');
        $company->save();

        $jefe = User::find($request->input('jefe_empresa'));
        if ($jefe) {
            $jefe->puesto = 'jefe';
            $jefe->save();
        }

        return back()->with('success', 'Empresa creada y rol de jefe asignado exitosamente.');
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
    public function update(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'string|max:255',
            'jefe_empresa' => 'required|exists:users,id',
        ]);

        // Obtenemos el ID de la empresa del usuario actualmente autenticado
        $id_empresa_usuario = auth()->user()->id_empresa;

        // Verificamos si el usuario tiene una empresa asignada
        if (!$id_empresa_usuario) {
            return back()->withErrors('El usuario no tiene una empresa asignada.');
        }

        // Buscamos la empresa correspondiente al ID del usuario
        $empresa = Empresa::findOrFail($id_empresa_usuario);

        // Obtener el ID del jefe anterior para actualizar su puesto
        $oldJefeId = $empresa->jefe_id;

        // Actualizar los datos de la empresa
        $empresa->name = $request->input('nombre_empresa');
        $empresa->jefe_id = $request->input('jefe_empresa');
        $empresa->save();

        // Actualizar los puestos del jefe anterior y el nuevo jefe
        if ($oldJefeId != $request->input('jefe_empresa')) {
            // Obtener el usuario anterior que era jefe y actualizar su puesto
            $oldJefe = User::find($oldJefeId);
            if ($oldJefe) {
                $oldJefe->puesto = 'camarero';
                $oldJefe->save();
            }

            // Obtener el nuevo jefe y actualizar su puesto
            $newJefe = User::find($request->input('jefe_empresa'));
            if ($newJefe) {
                $newJefe->puesto = 'jefe';
                $newJefe->save();
            }
        }

        return back()->with('success', 'Empresa actualizada y roles asignados correctamente.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Empresa::findOrFail($id);
        $jefe = User::find($company->jefe_id);
        $company->delete();

        if ($jefe) {
            $jefe->puesto = 'camarero';
            $jefe->save();
        }

        return back()->with('success', 'Empresa eliminada y rol de jefe cambiado a camarero exitosamente.');
    }
}
