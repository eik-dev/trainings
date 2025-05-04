<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId(column: 'training_id')->constrained('trainings')->onDelete('cascade');
            $table->foreignId(column: 'trainer_id')->constrained('trainers')->onDelete('cascade');
            $table->string(column: 'title');
            $table->longText(column: 'description');
            $table->string(column: 'type');
            $table->string(column: 'url');
            $table->string(column: 'status');
            $table->dateTime(column: 'time');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
