<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    public function getAll()
    {
        return DB::table('car_client')
            ->select('clients.*', 'car_client.*', 'cars.*')
            ->Join('clients', 'clients.id', 'car_client.client_id')
            ->Join('cars', 'cars.id', 'car_client.car_id')
            ->orderBy('car_client.client_id')
            ->paginate(5);
    }

    public function getSearch(Request $request)
    {
        return DB::table('car_client')
            ->select('clients.*', 'car_client.*', 'cars.*')
            ->Join('clients', 'clients.id', 'car_client.client_id')
            ->Join('cars', 'cars.id', 'car_client.car_id')
            ->orderBy('car_client.client_id')
            ->where('fio', 'like', '%'.$request->input('search').'%')
            ->paginate(5);
    }

    public function create(Request $request)
    {
        return DB::table('clients')->insert([
            'fio' => $request->input('fio'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);
    }



}
