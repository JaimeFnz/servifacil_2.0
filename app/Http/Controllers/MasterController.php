<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comanda;
use App\Models\Empresa;
use App\Models\Mesa;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{

    /**
     * Muestra la vista de gestión de usuarios.
     */
    public function users($id)
    {
        $user = User::where('id', $id)->first();
        $companies = Empresa::all();
        $positions = User::distinct()->pluck('puesto');

        return view('mgmt.master.user', compact('user', 'companies', 'positions'));
    }

    public function update(Request $request, $id)
    {
        try {


            // Validar los datos del formulario
            $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255', // Aquí el nombre del campo debe ser 'last_name' en lugar de 'surname'
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'dni' => 'required|string|max:255|unique:users,dni,' . $id,
                'password' => 'nullable|string|min:8',
                'company' => 'required|exists:empresa,id', // Aquí el nombre del campo debe ser 'company' en lugar de 'empresa'
                'position' => 'required|string|in:admin,jefe,camarero,cocinero',
            ]);

            // Obtener el usuario a actualizar
            $user = User::findOrFail($id);

            // Actualizar los datos del usuario
            $user->name = $request->name;
            $user->surname = $request->last_name; // Aquí se cambia 'surname' por 'last_name' para coincidir con el nombre del campo en la vista
            $user->email = $request->email;
            $user->dni = $request->dni;
            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->id_empresa = $request->company; // Aquí se cambia 'empresa' por 'company' para coincidir con el nombre del campo en la vista
            $user->puesto = $request->position;
            $user->save();

            // Redireccionar con un mensaje de éxito
            return redirect()->route('master-mgmt.index');
        } catch (\Throwable $th) {

        }
    }

    /**
     * Elimina un usuario.
     */
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('master-mgmt.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Error inesperado al eliminar el usuario: ' . $e->getMessage());
        }
    }


    /**
     * Muestra la vista de gestión de usuarios con los datos necesarios.
     */
    public function index()
    {
        $usrId = Auth::id();
        $usersData = User::where('id', '!=', $usrId)
            ->select('id', 'dni', 'name', 'surname', 'email', 'puesto')
            ->get();

        $allowedColumns = ['id', 'dni', 'name', 'surname', 'email', 'puesto'];
        $filteredColumns = $this->getFilteredColumns('users', $allowedColumns);

        $heads = $this->getTableHeads($filteredColumns);
        $config = $this->getTableConfig(count($filteredColumns));

        $cosData = Empresa::all();
        $coColumns = Schema::getColumnListing('empresa');
        $cosHeads = $this->getTableHeads($coColumns);
        $coConfig = $this->getTableConfig(count($coColumns));

        $users = User::whereNotIn('puesto', ['jefe', 'admin'])
            ->select('id', 'dni', 'name', 'puesto')
            ->get();

        return view('mgmt.master-mgmt', compact('usersData', 'cosData', 'heads', 'cosHeads', 'config', 'coConfig', 'users'));
    }

    /**
     * Obtiene las columnas filtradas permitidas de una tabla específica.
     *
     * @param string $table
     * @param array $allowedColumns
     * @return array
     */
    private function getFilteredColumns($table, $allowedColumns)
    {
        $columns = Schema::getColumnListing($table);
        return array_intersect($columns, $allowedColumns);
    }

    /**
     * Genera los encabezados de la tabla basados en las columnas proporcionadas.
     *
     * @param array $columns
     * @return array
     */
    private function getTableHeads($columns)
    {
        $heads = array_map(function ($column) {
            return ['label' => ucfirst($column)];
        }, $columns);
        $heads[] = ['label' => 'Actions', 'no-export' => true, 'width' => 5];
        return $heads;
    }

    /**
     * Configura las opciones de la tabla basadas en el número de columnas.
     *
     * @param int $columnsCount
     * @return array
     */
    private function getTableConfig($columnsCount)
    {
        $config = [
            'order' => [[1, 'asc']],
            'columns' => array_fill(0, $columnsCount, null),
        ];
        $config['columns'][] = ['orderable' => false];
        return $config;
    }
}
