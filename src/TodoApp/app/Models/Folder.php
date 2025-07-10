<?php

namespace App\Models;

use App\Models\Task\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $table = 'folders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'user_id',
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

    /**
     * ログインユーザーがこのフォルダの所有者か判定する
     *
     * @return bool
     */
    public function isOwnedByLoginUser(): bool
    {
        $user = Auth::user();
        return $user && $this->user_id === $user->id;
    }

    /**
     * フォルダのユーザー名を取得
     *
     * @return string|null
     */
    public function getUserNameAttribute()
    {
        return optional($this->user)->name;
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

    /**
     * フォルダテーブルとユーザーテーブルのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
