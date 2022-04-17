<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsultasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('unit_kerja');
            $table->string('jabatan');
            $table->string('tema');
            $table->string('pertanyaan',500);
            $table->integer('id_employee')->nullable();
            $table->string('unit_employee')->nullable();
            $table->string('jabatan_employee')->nullable();
            $table->enum('status',['Aktif','Selesai','Tatap Muka','Baru']);
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
        Schema::dropIfExists('konsultasis');
    }
}
