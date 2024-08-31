<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(){
    Schema::create('user_genis', function (Blueprint $table) {
        $table->id();
        $table->string('discord_id')->unique();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamps();
    });
}

public function down(){
    Schema::dropIfExists('user_genis');
}

};
