<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('mgmt.master-mgmt');
    }

    public function note()
    {
        return view ('mgmt.note-mgmt');
    }

    public function co()
    {
        return view ('mgmt.co-mgmt');
    }

    public function deks()
    {
        return view ('mgmt.desk-mgmt');
    }
}
