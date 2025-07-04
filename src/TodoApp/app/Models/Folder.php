<?php

namespace App\Models;

use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $table = 'folders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
    ];

    /**
     * 日付フォーマットがYYYY-MM-DDT00:00:00.000000Z(ISO8601)なので、Y-m-d H:i:sに変更する
     *
     * @param   string           \DateTimeInterface $date   DateTime や DateTimeImmutable を引数や戻り値、プロパティの型宣言で使えるようにしたインターフェース
     * @return  folders $date       foldersテーブルの日時のフォーマット化
     *
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /*
    * フォルダクラスとタスククラスを関連付けするメソッド
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'folder_id', 'id');
    }

}
