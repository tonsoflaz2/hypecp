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
        Schema::connection('csvs')->create('months', function (Blueprint $table) {
            $table->id();
            $table->string('hype_month');
            $table->string('csv');
            $table->unsignedInteger('count');
            $table->timestamps();

            $table->index(['hype_month', 'csv']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('csvs')->dropIfExists('months');
    }
};
