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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('nik', 16)->after('id');
            $table->string('alamat', 255)->after('name');
            $table->string('jk', 1)->after('email');
            $table->string('noTel', 15)->after('password');
            $table->string('status', 20)->nullable()->after('noTel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('nik');
            $table->dropColumn('alamat');
            $table->dropColumn('jk');
            $table->dropColumn('noTel');
            $table->dropColumn('status');
        });
    }
};
