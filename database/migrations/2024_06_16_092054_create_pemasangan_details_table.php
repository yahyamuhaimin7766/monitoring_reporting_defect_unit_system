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
        Schema::create('pemasangan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pemasangan_id')->nullable();
            $table->string('problem', 255)->nullable();
            $table->string('analisa', 255)->nullable();
            $table->string('action', 255)->nullable();
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
        Schema::dropIfExists('pemasangan_details');
    }
};
