<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\JsonResponse;

class ZoneController extends Controller
{
    public function index(int $id): JsonResponse
    {
        if(!$id){
            return response()->json([
                'message' => 'No se encontró la zona'
            ], 500);
        }

        try{
            $zones = Zone::where('city_id', $id)->get();
            return response()->json([
                'zones' => $zones,
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al obtener zona',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
