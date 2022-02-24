<?php

namespace App\Models;

use Carbon\Carbon;
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
            ->orderByDesc('car_client.client_id')
            ->paginate(5);
    }

    public function getSearch(Request $request)
    {
        try {
            DB::table('car_client')
                ->select('clients.*', 'car_client.*', 'cars.*')
                ->Join('clients', 'clients.id', 'car_client.client_id')
                ->Join('cars', 'cars.id', 'car_client.car_id')
                ->orderBy('car_client.client_id')
                ->where('fio', 'like', '%'.$request->input('search').'%')
                ->paginate(5);
        } catch (\Exception $exception) {

            return back();
        }

        return DB::table('car_client')
            ->select('clients.*', 'car_client.*', 'cars.*')
            ->Join('clients', 'clients.id', 'car_client.client_id')
            ->Join('cars', 'cars.id', 'car_client.car_id')
            ->orderBy('car_client.client_id')
            ->where('fio', 'like', '%'.$request->input('search').'%')
            ->paginate(5);
    }

    public function createClient(Request $request)
    {
        return DB::table('clients')->insert([
            'fio' => $request->input('fio'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function getClientId (Request $request) {
        return DB::table('clients')->where('phone', $request->input('phone'))
            ->get();
    }

    public function editClient($id)
    {
        return DB::table('clients')
            ->where('id', $id)
            ->get();
    }
    
    public function storeClient(Request $request, $id)
    {
        return DB::table('clients')->where('id', $id)->update([
            'fio' => $request->input('fio'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);
    }

    public function delClientWithCars($client_id)
    {
        $allCarsNoClient = DB::table('car_client')->where('client_id','!=', $client_id)->get();
        $allCarClient = DB::table('car_client')->where('client_id', $client_id)->get();

        $carsNoClient = [];
        foreach ($allCarsNoClient as $items){
            array_push($carsNoClient, $items->car_id);
        }

        $carsClient = [];
        foreach ($allCarClient as $item){
            array_push($carsClient, $item->car_id);
        }
        $carsDel = array_diff($carsClient, $carsNoClient);

        if ($carsDel) {
            foreach ($carsDel as $carDel) {
                DB::table('cars')->where('id', $carDel)->delete();
            }
        }

        DB::table('car_client')->where('client_id','=', $client_id)->delete();
        DB::table('clients')->where('id','=', $client_id)->delete();

    }


}
