<?php
namespace App\Services\Arduino;

use Illuminate\Support\Facades\DB;

class ArduinoService
{
    public function processData($data)
    {
        // Processa os dados aqui
        DB::table('arduino_data')->insert(['data' => $data]);
    }
}
?>