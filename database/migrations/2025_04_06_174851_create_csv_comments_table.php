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
        Schema::connection('csvs')->create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('month')->index();
            $table->unsignedInteger('likes')->default(0);
            $table->string('author')->nullable();
            $table->text('comment')->nullable();
            $table->text('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('csvs')->dropIfExists('comments');
    }
};
