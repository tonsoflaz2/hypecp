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
        Schema::connection('wave')->create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->string('name');
            $table->timestamps();
        });

        Schema::connection('wave')->create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('room_id')->index();
            $table->string('name');
            $table->timestamps();
        });

        Schema::connection('wave')->create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('room_id')->index();
            $table->unsignedInteger('member_id');
            $table->dateTime('sent_at')->nullable();
            $table->text('content')->nullable();
            $table->bigInteger('updated_milliseconds');
            $table->softDeletes();
            $table->timestamps();

            // Add a composite index on room_id and sent_at
            $table->index(['room_id', 'sent_at']);
            $table->index(['room_id', 'updated_milliseconds']);
            $table->index(['room_id', 'member_id']);

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('wave')->dropIfExists('rooms');
        Schema::connection('wave')->dropIfExists('members');
        Schema::connection('wave')->dropIfExists('chats');
    }
};
