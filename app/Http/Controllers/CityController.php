<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function index(int $id): JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró la ciudad'
            ], 500);
        }

        try{
            $cities = City::where('province_id', $id)->get();
            return response()->json([
                'cities' => $cities,
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al obtener ciudad',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
