<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTatapMukasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tatap_mukas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_konsultasi');
            $table->integer('id_user');
            $table->integer('id_employee')->nullable();
            $table->date('tanggal');
            $table->enum('status',['Menunggu Konfirmasi','Ajukan Ulang', 'Disetujui','Selesai']);
            $table->string('phone');
            $table->text('hasil')->nullable();
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
        Schema::dropIfExists('tatap_mukas');
    }
}
