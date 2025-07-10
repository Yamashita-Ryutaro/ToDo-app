<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstSystemMail extends Model
{
    use HasFactory;
    protected $table = 'mst_system_mails';
    protected $fillable = [
        'display_name',
    ];

    public function systemMail()
    {
        return $this->belongsTo(SystemMail::class, 'id', 'system_mail_id');
    }
}