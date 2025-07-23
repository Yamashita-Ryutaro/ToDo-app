<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemMail extends Model
{
    use HasFactory;
    protected $table = 'system_mails';
    protected $fillable = [
        'subject',
        'body',
        'action_text',
        'system_mail_id',
    ];


    /**
     * 中間テーブルからURLのkeyを取得
     * 
     * @return string|null
     */
    public function getUrlKeyAttribute()
    {
        $mstSystemMail = $this->mstSystemMail;

        // 中間テーブルからid=1のkeyを取得
        $key = $mstSystemMail
            ->mailKeyMailMaps()
            ->where('mst_system_mail_key_id', 1)
            ->first()?->mstSystemMailKey;

        return $key?->key;
    }

    /**
     * 中間テーブルからタスクのkeyを取得
     * 
     * @return string|null
     */
    public function getTaskKeyAttribute()
    {
        $mstSystemMail = $this->mstSystemMail;

        // 中間テーブルからid=2のkeyを取得
        $key = $mstSystemMail
            ->mailKeyMailMaps()
            ->where('mst_system_mail_key_id', 2)
            ->first()?->mstSystemMailKey;

        return $key?->key;
    }

    /**
     * 中間テーブルから新しいメールのkeyを取得
     * 
     * @return string|null
     */
    public function getNewEmailKeyAttribute()
    {
        $mstSystemMail = $this->mstSystemMail;

        // 中間テーブルからid=3のkeyを取得
        $key = $mstSystemMail
            ->mailKeyMailMaps()
            ->where('mst_system_mail_key_id', 3)
            ->first()?->mstSystemMailKey;

        return $key?->key;
    }

    public function mstSystemMail()
    {
        return $this->belongsTo(MstSystemMail::class, 'system_mail_id', 'id');
    }
}