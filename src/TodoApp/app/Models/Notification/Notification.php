<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = [
        'subject',
        'body',
        'date_key',
        'url_key',
        'url',
        'date',
        'notification_id',
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

    public function mstNotification()
    {
        return $this->belongsTo(MstNotification::class, 'notification_id');
    }
}
