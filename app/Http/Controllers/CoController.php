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
    public function update(Request $request, string $id)
    {
        //
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
