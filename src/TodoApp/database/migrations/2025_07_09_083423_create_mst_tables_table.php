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
        Schema::create('mst_tables', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->unique(); // マスタテーブル名
            $table->string('display_name');         // 表示名
            $table->string('description')->nullable(); // 説明
            $table->boolean('is_active')->default(true); // サイト運営者が操作できるか
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
        Schema::dropIfExists('mst_tables');
    }
};
