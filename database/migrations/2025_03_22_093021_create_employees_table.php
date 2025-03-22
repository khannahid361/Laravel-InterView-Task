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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('salary', 10, 2); 
            $table->date('start_date')->index(); 
            $table->foreignId('team_id')
                  ->constrained('teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();

            
            $table->index('team_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
