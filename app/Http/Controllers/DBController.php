<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Mesa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mgmt.master-mgmt');
    }

    public function note()
    {
        // Obtener todos los datos de la tabla 'comanda'
        $data = Comanda::all();

        // Obtener los nombres de las columnas de la tabla 'comanda'
        $columns = Schema::getColumnListing('comanda');

        // Definir los 'heads' utilizando los nombres de las columnas obtenidas
        $heads = [];
        foreach ($columns as $column) {
            $heads[] = ['label' => ucfirst($column)];
        }

        $heads[] = ['label' => 'Actions', 'no-export' => true, 'width' => 5];

        $config = [
            'order' => [[1, 'asc']],
            'columns' => array_fill(0, count($columns), null),
        ];
        // Hacer la última columna no ordenable
        $config['columns'][] = ['orderable' => false];

        return view('mgmt.note-mgmt', compact('data', 'heads', 'config'));
    }

    public function co()
    {
        

        return view('mgmt.co-mgmt');
    }

    public function desk()
    {
        // Obtener todos los datos de la tabla 'mesa'
        $data = Mesa::all();

        // Obtener los nombres de las columnas de la tabla 'mesa'
        $columns = Schema::getColumnListing('mesa');

        // Definir los 'heads' utilizando los nombres de las columnas obtenidas
        $heads = [];
        foreach ($columns as $column) {
            $heads[] = ['label' => ucfirst($column)];
        }

        $heads[] = ['label' => 'Actions', 'no-export' => true, 'width' => 5];

        $config = [
            'order' => [[1, 'asc']],
            'columns' => array_fill(0, count($columns), null),
        ];
        // Hacer la última columna no ordenable
        $config['columns'][] = ['orderable' => false];

        $waiters = User::where('puesto', 'camarero')->get();

        return view('mgmt.desk-mgmt', compact('data', 'heads', 'config', 'waiters'));
    }
}
