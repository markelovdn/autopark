<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory;

    public function create(Request $request)
    {
        return DB::table('cars')->insert([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'num' => $request->input('num'),
            'onpark' => $request->input('onpark'),
            'color' => $request->input('color'),
        ]);
    }
}
