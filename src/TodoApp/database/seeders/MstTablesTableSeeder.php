<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\MstTables;

class MstTablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MstTables::create([
            'table_name' => 'mst_task_statuses',
            'display_name' => 'タスクステータス',
            'description' => 'タスクの進捗状況を管理するマスターテーブル',
            'is_active' => true,
        ]);
        MstTables::create([
            'table_name' => 'mst_admin',
            'display_name' => '管理者マスタ',
            'description' => 'アプリケーションの管理者情報を管理するマスターテーブル',
            'is_active' => false,
        ]);
        MstTables::create([
            'table_name' => 'mst_system_mails',
            'display_name' => 'システムメールマスタ',
            'description' => 'アプリケーションのシステムメール情報を管理するマスターテーブル',
            'is_active' => false,
        ]);
    }
}
