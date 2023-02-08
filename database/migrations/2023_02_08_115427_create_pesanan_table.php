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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();

            $table->char('NIK_pasien',16);
            $table->foreign('NIK_pasien')->references('NIK')->on('users');

            $table->unsignedBigInteger('id_layanan');
            $table->foreign('id_layanan')->references('id')->on('layanan');

            $table->char('id_status_jasa');
            $table->foreign('id_status_jasa')->references('id')->on('status_user');

            $table->char('NIK_jasa',16)->nullable();
            $table->foreign('NIK_jasa')->references('NIK')->on('users');

            $table->text('alamat');
            $table->integer("harga")->nullable();
            $table->text('keluhan')->nullable(); 
            $table->string("foto")->nullable();

            $table->char('id_status_layanan')->default('W');
            $table->foreign('id_status_layanan')->references('id')->on('status_layanan');

            $table->enum('status_pembayaran', ['Y', 'T'])->default('T');
            
            $table->string("bukti_pembayaran")->nullable(); 
            $table->date('tanggal_perawatan');
            $table->dateTime('jam_perawatan');   

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
        Schema::dropIfExists('pesanan');
    }
};
