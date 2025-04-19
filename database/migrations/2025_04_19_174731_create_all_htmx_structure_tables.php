<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // Ensure the SQLite file exists
        $dbPath = database_path('structure.sqlite');
        if (!File::exists($dbPath)) {
            File::put($dbPath, '');
        }

        Schema::connection('structure')->create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('from');
            $table->string('to');
            $table->string('status');
            $table->text('full_text');
            $table->timestamps();
        });
        Schema::connection('structure')->create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->timestamps();
        });
        Schema::connection('structure')->create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::connection('structure')->create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::connection('structure')->create('email_person', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('email_id');
            $table->unsignedInteger('person_id');
            $table->timestamps();
        });
        Schema::connection('structure')->create('email_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('email_id');
            $table->unsignedInteger('tag_id');
            $table->timestamps();
        });
        Schema::connection('structure')->create('campaign_email', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('email_id');
            $table->unsignedInteger('campaign_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
