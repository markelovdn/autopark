<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index (Client $clients)
    {
        $clients = $clients->getAll();
        return view('admin.clients.index', ['clients' => $clients]);
    }

    public function search (Request $request, Client $clients)
    {
        $clients = $clients->getSearch($request);

        return view('admin.clients.index', ['clients' => $clients]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fio' => 'required|min:3',
            'gender' => 'required',
            'phone' => 'required|unique:clients',
            'model' => 'required|min:3',
            'brand' => 'required',
            'num' => 'required',
        ])->validate();

        DB::table('clients')->insert([
            'fio' => $request->input('fio'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        DB::table('cars')->insert([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'num' => $request->input('num'),
            'onpark' => $request->input('onpark'),
            'color' => $request->input('color'),
        ]);

        $carsId = DB::table('cars')->where('num', $request->input('num'))
            ->get();
        $clientId = DB::table('clients')->where('phone', $request->input('phone'))
            ->get();

        DB::table('car_client')->insert([
            'client_id' => $clientId[0]->id,
            'car_id' => $carsId[0]->id,
        ]);

        return redirect(route('clients'));
    }

    public function edit($id)
    {
        $client = DB::table('clients')
            ->where('id', $id)
            ->get();

        $cars = DB::table('car_client')
            ->select('car_client.*', 'cars.*')
            ->Join('clients', 'clients.id', 'car_client.client_id')
            ->Join('cars', 'cars.id', 'car_client.car_id')
            ->where('client_id', $id)
            ->get();

        return view('admin.clients.edit', ['client' => $client, 'cars' => $cars]);
    }

    public function store (Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fio' => 'required|min:3',
            'gender' => 'required',
            'phone' => 'required|unique:clients',
        ])->validate();

        DB::table('clients')->where('id', $id)->update([
            'fio' => $request->input('fio'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        return back();
    }

    public function delete ($client_id)
    {
        DB::table('clients')->where('id', $client_id)->delete();

        return back();
    }
}
