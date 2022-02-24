<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory;

    public function getSearch(Request $request)
    {
        return DB::table('cars')
            ->where('num', 'like', '%'.$request->input('search').'%')
            ->paginate(10);
    }

    public function getCarId (Request $request)
    {
       return DB::table('cars')->where('num', $request->input('num'))
            ->get();
    }
    
    public function createCar(Request $request)
    {
        return DB::table('cars')->insert([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'num' => $request->input('num'),
            'onpark' => $request->input('onpark'),
            'color' => $request->input('color'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
    
    public function updateCar(Request $request, $id)
    {
        return DB::table('cars')->where('id', $id)->update([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'num' => $request->input('num'),
            'onpark' => $request->input('onpark'),
            'color' => $request->input('color'),
            'updated_at' => Carbon::now()
        ]);
    }

    public function linkCarWhitClient(Request $request, Client $client)
    {
        $carsId = $this->getCarId($request);
        $clientId = $client->getClientId($request);
        
        return DB::table('car_client')->insert([
            'client_id' => $clientId[0]->id,
            'car_id' => $carsId[0]->id,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
    }
    
    public function getClientWhitCars($id)
    {
        return DB::table('car_client')
            ->select('car_client.*', 'cars.*')
            ->Join('clients', 'clients.id', 'car_client.client_id')
            ->Join('cars', 'cars.id', 'car_client.car_id')
            ->where('client_id', $id)
            ->get();
    }
    
    public function parkingCar($id)
    {
        return DB::table('cars')->where('id', $id)->update([
            'onpark' => 1,
            'updated_at' => Carbon::now()
        ]);
    }
    
    public function onParkCar()
    {
        return DB::table('cars')
            ->where('cars.onpark', 1)
            ->paginate(10);
    }

    public function outParkCar($id)
    {
        return DB::table('cars')->where('id', $id)->update([
            'onpark' => 0,
        ]);
    }

    public function deleteCar($id)
    {
        return DB::table('cars')->where('id', $id)->delete();
    }
    
    
}
