<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Empresa;
use App\Models\Mesa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class DBController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * It retrieves the logged user's ID and fetches all users except the logged user.
     * 
     * Then it filters the columns, defines the 'heads', sets up the configuration for the datatable,
     * and returns the 'mgmt.master-mgmt' view with the necessary data.
     */
    public function index()
    {
        $usrId = Auth::id();
        $usersData = User::where('id', '!=', $usrId)->select('id', 'dni', 'name', 'surname', 'email', 'puesto')->get();
        $allowedColumns = ['id', 'dni', 'name', 'surname', 'email', 'puesto'];
        $columns = Schema::getColumnListing('users');
        $filteredColumns = array_intersect($columns, $allowedColumns);
        $heads = array_map(function ($column) {
            return ['label' => ucfirst($column)];
        }, $filteredColumns);
        $heads[] = ['label' => 'Actions', 'no-export' => true, 'width' => 5];
        $config = [
            'order' => [[1, 'asc']],
            'columns' => array_fill(0, count($filteredColumns), null),
        ];
        $config['columns'][] = ['orderable' => false];


        $cosData = Empresa::all();
        $coColumns = Schema::getColumnListing('empresa');
        $users = User::where('puesto', '!=', 'jefe')->where('puesto', '!=', 'admin')->select('id', 'dni', 'name', 'puesto')->get();
            $cosHeads = array_map(function ($column) {
            return ['label' => ucfirst($column)];
        }, $coColumns);
        $cosHeads[] = ['label' => 'Actions', 'no-export' => true, 'width' => 5];
        $coConfig = [
            'order' => [[1, 'asc']],
            'columns' => array_fill(0, count($coColumns), null),
        ];
        $coConfig['columns'][] = ['orderable' => false];

        return view('mgmt.master-mgmt', compact('usersData', 'cosData', 'heads', 'cosHeads', 'config', 'coConfig', 'users'));
    }


    /**
     * Display a listing of the notes.
     * 
     * It fetches all the data from the 'comanda' table,
     * retrieves the column names from the 'comanda' table,
     * defines the 'heads' using the retrieved column names,
     * and sets up the configuration for the datatable.
     */
    public function note()
    {
        $data = Comanda::all();
        $columns = Schema::getColumnListing('comanda');
        $heads = array_map(function ($column) {
            return ['label' => ucfirst($column)];
        }, $columns);
        $heads[] = ['label' => 'Actions', 'no-export' => true, 'width' => 5];
        $config = [
            'order' => [[1, 'asc']],
            'columns' => array_fill(0, count($columns), null),
        ];
        $config['columns'][] = ['orderable' => false];

        return view('mgmt.note-mgmt', compact('data', 'heads', 'config'));
    }

    /**
     * This function manages the mgmt.co-mgmt view.
     * 
     * First it takes the id of the logged user in order to see 
     * in which company he's working, then takes all the users assigned 
     * to that company.
     * 
     * After that, it fetches the company data, filters the columns, 
     * defines the 'heads', sets up the configuration for the datatable, 
     * and returns the 'mgmt.co-mgmt' view with the necessary data.
     */
    public function co()
    {
        $usr = Auth::user();
        $id = $usr->workingFor();
        $data = User::where('id_empresa', $id)
            ->select('id', 'dni', 'name', 'surname', 'email', 'puesto')
            ->get();

        $co = Empresa::find($id);
        $users = User::where('id_empresa', $id)
            ->select('dni', 'name', 'puesto')
            ->get();


        $allowedColumns = ['id', 'dni', 'name', 'surname', 'email', 'puesto'];
        $columns = Schema::getColumnListing('users');
        $filteredColumns = array_intersect($columns, $allowedColumns);

        $heads = array_map(function ($column) {
            return ['label' => ucfirst($column)];
        }, $filteredColumns);
        $heads[] = ['label' => 'Actions', 'no-export' => true, 'width' => 5];

        $config = [
            'order' => [[1, 'asc']],
            'columns' => array_fill(0, count($filteredColumns), null),
        ];
        $config['columns'][] = ['orderable' => false];

        return view('mgmt.co-mgmt', compact('data', 'heads', 'config', 'co', 'users'));
    }


    /**
     * Display a listing of the desks.
     * 
     * It fetches all the data from the 'mesa' table,
     * retrieves the column names from the 'mesa' table,
     * defines the 'heads' using the retrieved column names,
     * sets up the configuration for the datatable,
     * and retrieves all the users with the role 'camarero'.
     */
    public function desk()
    {
        // Obtener todos los datos de la tabla 'mesa'
        $data = Mesa::all();

        // Obtener los nombres de las columnas de la tabla 'mesa'
        $columns = Schema::getColumnListing('mesa');

        // Definir los 'heads' utilizando los nombres de las columnas obtenidas
        $heads = array_map(function ($column) {
            return ['label' => ucfirst($column)];
        }, $columns);
        $heads[] = ['label' => 'Actions', 'no-export' => true, 'width' => 5];

        $config = [
            'order' => [[1, 'asc']],
            'columns' => array_fill(0, count($columns), null),
        ];
        $config['columns'][] = ['orderable' => false];
        $waiters = User::where('puesto', 'camarero')->get();

        return view('mgmt.desk-mgmt', compact('data', 'heads', 'config', 'waiters'));
    }
}
