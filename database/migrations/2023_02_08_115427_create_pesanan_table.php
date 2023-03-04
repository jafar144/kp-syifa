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

            $table->unsignedBigInteger('id_pasien');
            $table->foreign('id_pasien')->references('id')->on('users');
            

            $table->unsignedBigInteger('id_layanan');
            $table->foreign('id_layanan')->references('id')->on('layanan');

            $table->char('id_status_jasa')->nullable();
            $table->foreign('id_status_jasa')->references('id')->on('status_user');

            $table->unsignedBigInteger('id_jasa')->nullable();
            $table->foreign('id_jasa')->references('id')->on('users');

            $table->text('keluhan')->nullable(); 
            $table->string("foto")->nullable();
            $table->date('tanggal_perawatan');
            $table->time('jam_perawatan');  

            $table->text('alamat');
            $table->integer("harga")->nullable();
            $table->integer("ongkos")->default(0);
            

            $table->char('id_status_layanan')->default('M')->nullable();
            $table->foreign('id_status_layanan')->references('id')->on('status_layanan');

            $table->enum('status_pembayaran', ['Y', 'T'])->default('T');
            
            $table->string("bukti_pembayaran")->nullable(); 
             

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
