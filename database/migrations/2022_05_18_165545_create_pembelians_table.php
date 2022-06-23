<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier');
            $table->string('harga_super')->nullable();
            $table->string('tonase_super')->nullable();
            $table->string('harga_bulat')->nullable();
            $table->string('tonase_bulat')->nullable();
            $table->string('harga_sortiran')->nullable();
            $table->string('tonase_sortiran')->nullable();
            $table->string('total_super')->nullable();
            $table->string('total_bulat')->nullable();
            $table->string('total_sortiran')->nullable();
            $table->string('total_biaya')->nullable();
            $table->string('total_tonase')->nullable();
            $table->bigInteger('periode_id')->unsigned();
            $table->foreign('periode_id')->references('id')->on('periodes')->onDelete('cascade');
            $table->bigInteger('datausaha_id')->unsigned();
            $table->foreign('datausaha_id')->references('id')->on('datausahas')->onDelete('cascade');
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
        Schema::dropIfExists('pembelians');
    }
}