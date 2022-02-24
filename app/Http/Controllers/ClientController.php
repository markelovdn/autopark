<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Car;
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
        $validator = Validator::make($request->all(), [
            'search' => 'regex:/^[a-zA-Zа-яА-Я]+$/',
        ])->validate();

        $clients = $clients->getSearch($request);
        return view('admin.clients.index', ['clients' => $clients]);
    }

    public function create(Request $request, Client $client, Car $car)
    {
        $validator = Validator::make($request->all(), [
            'fio' => 'required|min:3|max:255',
            'gender' => 'required|max:255',
            'phone' => 'required|unique:clients|max:20',
            'address' => 'max:255',
            'model' => 'required|min:3|max:255',
            'brand' => 'required|max:255',
            'num' => 'required|max:20',
            'color' => 'max:255',
        ])->validate();

        $client->createClient($request);
        $car->createCar($request);
        $car->linkCarWhitClient($request, $client);

        return redirect(route('clients'));
    }

    public function edit(Client $client, Car $car, $id)
    {
        $client = $client->editClient($id);
        $cars = $car->getClientWhitCars($id);

        return view('admin.clients.edit', ['client' => $client, 'cars' => $cars]);
    }

    public function store (Request $request, Client $client, $id)
    {
        $validator = Validator::make($request->all(), [
            'fio' => 'required|min:3|max:255',
            'gender' => 'required|max:255',
            'phone' => 'required|unique:clients|max:20',
            'address' => 'max:255',
        ])->validate();

        $client->storeClient($request, $id);

        return back();
    }

    public function delete (Client $client, $client_id)
    {
        $client->delClientWithCars($client_id);
        return back();
    }
}
