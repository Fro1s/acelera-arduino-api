<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArduinoDataTable extends Migration
{
    public function up()
    {
        Schema::create('arduino_data', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arduino_data');
    }
}
