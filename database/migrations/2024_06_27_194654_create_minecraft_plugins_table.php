<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minecraft_plugins', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('xp_level');
            $table->json('inventory');
            $table->integer('online_time'); // in seconds
            $table->timestamp('last_time_online')->nullable();
            $table->timestamp('first_time_online')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minecraft_plugins');
    }
};
