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

    public function mstSystemMail()
    {
        return $this->belongsTo(MstSystemMail::class, 'system_mail_id', 'id');
    }

    public function keys()
    {
        return $this->hasMany(SystemMailKey::class, 'system_mails_id');
    }
}
