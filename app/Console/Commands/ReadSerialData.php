<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use React\ChildProcess\Process;
use React\EventLoop\Factory;

class ReadSerialData extends Command
{
    protected $signature = 'serial:read';
    protected $description = 'Read data from serial port and save to database';

    public function handle()
    {
        $port = 'COM3'; // Porta serial no Windows
        $baudRate = 9600;

        $this->info('Reading from serial port...');

        exec("mode $port BAUD=$baudRate PARITY=N data=8 stop=1 xon=off");

        $serial = fopen($port, 'r+b');

        if ($serial === false) {
            $this->error('Failed to open serial port');
            return;
        }

        while ($serial !== false) {
            $data = fgets($serial);

            if ($data !== false) {
                try {
                    $this->validateAndSaveData($data);
                    $this->info('Data saved successfully: ' . $data);
                } catch (ValidationException $e) {
                    $this->error('Failed to save data: ' . $e->getMessage());
                }
            }

            usleep(500000); // Aguarda meio segundo antes de ler novamente
        }

        fclose($serial);
    }

    protected function validateAndSaveData($data)
    {
        $validator = Validator::make(['data' => $data], [
            'data' => 'required|json',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        Log::info('Data read from serial port: ' . $data);

        $jsonData = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Failed to decode JSON: ' . json_last_error_msg());
        }

        try {
            DB::table('sensor_data')->insert([
                'sensor' => $jsonData['sensor'],
                'valor' => $jsonData['valor'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to insert data into database: ' . $e->getMessage());
        }
    }
}