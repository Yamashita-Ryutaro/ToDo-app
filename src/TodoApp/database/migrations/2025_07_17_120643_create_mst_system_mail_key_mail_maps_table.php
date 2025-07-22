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
        Schema::create('mst_system_mail_key_mail_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mst_system_mail_id');
            $table->unsignedBigInteger('mst_system_mail_key_id');
            $table->timestamps();

            $table->foreign('mst_system_mail_id')->references('id')->on('mst_system_mails')->onDelete('cascade');
            $table->foreign('mst_system_mail_key_id')->references('id')->on('mst_system_mail_keys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_system_mail_key_mail_maps');
    }
};