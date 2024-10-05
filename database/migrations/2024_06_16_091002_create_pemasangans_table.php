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
        Schema::create('pemasangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer',50)->nullable();
            $table->string('nomor_telepon',15);
            $table->string('nomor_mesin',15);
            $table->string('nomor_sasis',15);
            $table->string('jenis_kendaraan',15);
            $table->string('merek_kendaraan', 50);
            $table->string('nopol',25);
            $table->string('alamat',255);
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
        Schema::dropIfExists('pemasangans');
    }
};
