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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string("pegawai_nip", 18)->unique();
            $table->string("pegawai_nama", 100);
            $table->string("pegawai_glr_depan", 15);
            $table->string("pegawai_glr_blkg", 25);
            $table->string("pegawai_jabatan", 75);
            $table->string("pegawai_golongan", 5);
            $table->string("pegawai_unor", 100);
            $table->boolean("pegawai_status")->default(false); // true: Aktif / false: Tidak Aktif
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
        Schema::dropIfExists('pegawai');
    }
};
