<?php

namespace App\Http\Controllers\Arduino;

use Illuminate\Http\Request;
use App\Models\ArduinoData;
use App\Http\Controllers\Controller;

class ArduinoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'uuid' => 'required|string',
        ]);

        $arduinoData = new ArduinoData();
        $arduinoData->uuid = $request->uuid;
        $arduinoData->save();

        return response()->json(['message' => 'Dados do Arduino salvos com sucesso'], 201);
    }


    public function index()
    {
        $arduinoData = ArduinoData::all();

        return response()->json($arduinoData);
    }
}
