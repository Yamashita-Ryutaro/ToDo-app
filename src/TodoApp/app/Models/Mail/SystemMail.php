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
        'url_key',
        'action_text',
        'system_mail_id',
    ];

    public function mstSystemMail()
    {
        return $this->belongsTo(MstSystemMail::class, 'system_mail_id', 'id');
    }
}
