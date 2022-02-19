<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index()
    {
        $cars = DB::table('cars')
            ->where('cars.onpark', 1)
            ->get();

        $allCars = DB::table('cars')
            ->get();

        $clients = DB::table('clients')
            ->get();

        return view('admin.index', ['cars' => $cars, 'allCars' => $allCars, 'clients' => $clients]);
    }
}
