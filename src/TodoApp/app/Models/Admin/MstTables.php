<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstTables extends Model
{
    use HasFactory;
    protected $table = 'mst_tables'; // マスタテーブル名
    protected $fillable = [
        'table_name',       // マスタテーブル名
        'display_name',     // 表示名
        'description',      // 説明
        'is_active',        // サイト運営者が操作できるか
    ];
}
