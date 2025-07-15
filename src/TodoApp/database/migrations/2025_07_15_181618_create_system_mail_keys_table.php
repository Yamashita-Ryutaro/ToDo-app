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
        Schema::create('system_mail_keys', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('system_mails_id')->unsigned();
            $table->string('key');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('system_mails_id')->references('id')->on('system_mails')->onDelete('cascade');
            $table->unique(['system_mails_id', 'key']); // 複合ユニーク
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_mail_keys');
    }
};
