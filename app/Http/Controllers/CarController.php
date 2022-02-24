<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function search (Request $request, Car $car)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'regex:/^[a-zA-Zа-яА-Я0-9]+$/',
        ])->validate();

        $cars = $car->getSearch($request);

        return view('admin.cars.onpark', ['cars' => $cars]);
    }

    public function create(Request $request, Car $car, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'model' => 'required|min:3|max:255',
            'brand' => 'required|max:255',
            'num' => 'required|max:12',
            'color' => 'max:255',
        ])->validate();

        $car->createCar($request);
        $car->linkCarWhitClient($request, $client);

        return back();
    }

    public function update(Request $request, Car $car, $id)
    {
        $validator = Validator::make($request->all(), [
            'model' => 'required|min:3|max:255',
            'brand' => 'required|max:255',
            'num' => 'required|max:12',
            'color' => 'max:255',
        ])->validate();

        $car->createCar($request, $id);

        return back();
    }

    public function parking (Car $car, $id)
    {
        $car->parkingCar($id);

        return back();
    }

    public function onPark (Car $car)
    {
        $cars = $car->onParkCar();

        return view('admin.cars.onpark', ['cars' => $cars]);
    }

    public function outPark (Car $car, $id)
    {
        $car->outParkCar($id);

        return back();
    }

    public function delete (Car $car, $id)
    {
        $car->deleteCar($id);

        return back();
    }
}
