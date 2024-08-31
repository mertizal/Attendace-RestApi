<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

public function up(){
    Schema::create('monthly_attendance_scores', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_genis_id')->constrained('user_genis')->onDelete('cascade');
        $table->string('month');
        $table->integer('score');
        $table->timestamps();
    });
}

public function down(){
    Schema::dropIfExists('monthly_attendance_scores');
}};
