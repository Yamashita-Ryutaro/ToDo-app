<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemMailKey extends Model
{
    use HasFactory;

    protected $table = 'system_mail_keys';
    protected $fillable = [
        'key',
        'description',
    ];

    public function systemMail()
    {
        return $this->belongsTo(SystemMail::class, 'system_mails_id');
    }
}
