<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function search (Request $request)
    {
        $cars = DB::table('cars')
            ->where('num', 'like', '%'.$request->input('search').'%')
            ->paginate(10);

        return view('admin.cars.onpark', ['cars' => $cars]);

    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'model' => 'required|min:3',
            'brand' => 'required',
            'num' => 'required',
        ])->validate();

        DB::table('cars')->insert([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'num' => $request->input('num'),
            'onpark' => $request->input('onpark'),
            'color' => $request->input('color'),
        ]);

        $carsId = DB::table('cars')->where('num', $request->input('num'))
            ->get();

        DB::table('car_client')->insert([
            'client_id' => $request->input('client_id'),
            'car_id' => $carsId[0]->id,
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'model' => 'required|min:3',
            'brand' => 'required',
            'num' => 'required',
        ])->validate();

        DB::table('cars')->where('id', $id)->update([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'num' => $request->input('num'),
            'onpark' => $request->input('onpark'),
            'color' => $request->input('color'),
            'updated_at' => Carbon::now()
        ]);

        return back();
    }

    public function onPark ()
    {
        $cars = DB::table('cars')
            ->where('cars.onpark', 1)
            ->paginate(10);

        return view('admin.cars.onpark', ['cars' => $cars]);
    }

    public function outPark ($id)
    {
        DB::table('cars')->where('id', $id)->update([
            'onpark' => 0,
        ]);

        return back();
    }

    public function delete ($id)
    {
        DB::table('cars')->where('id', $id)->delete();

        return back();
    }
}
