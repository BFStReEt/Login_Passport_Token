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
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id')->length(11);

            $table->string("username", 150)->nullable()->default('');
            $table->string('email', 200)->nullable()->default('NULL');
            $table->string("password", 100)->default('');
            $table->string("address", 200)->nullable()->default('NULL');
            $table->string('full_name', 250)->nullable();
            $table->string('phone', 50)->nullable()->default('NULL');
            $table->integer('status')->defaut(0);
            $table->integer('m_status')->defaut(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
