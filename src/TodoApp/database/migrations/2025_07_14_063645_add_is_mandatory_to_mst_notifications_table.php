<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mst_notifications', function (Blueprint $table) {
            $table->boolean('is_mandatory')->default(false)->after('display_name');
        });
    }

    public function down()
    {
        Schema::table('mst_notifications', function (Blueprint $table) {
            $table->dropColumn('is_mandatory');
        });
    }
};
