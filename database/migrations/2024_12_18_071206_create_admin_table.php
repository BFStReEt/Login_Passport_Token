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
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id')->length(10);
            $table->string('username', 50);
            $table->string('password', 250);
            $table->string('email', 100);
            $table->string('display_name', 250);
            $table->string('avatar', 250)->nullable()->default('NULL');
            $table->string('skin', 250)->default('blue');
            $table->string('lastlogin', 150)->default('0');
            $table->integer('status')->length(11)->default('2');
            $table->string('phone', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
