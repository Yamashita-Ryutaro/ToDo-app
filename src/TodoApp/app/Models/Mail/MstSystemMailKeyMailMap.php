<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstSystemMailKeyMailMap extends Model
{
    use HasFactory;

    protected $table = 'mst_system_mail_key_mail_maps';

    protected $fillable = [
        'mst_system_mail_key_id',
        'system_mail_id',
    ];

    public function mstSystemMailKey()
    {
        return $this->belongsTo(MstSystemMailKey::class, 'mst_system_mail_key_id', 'id');
    }

    public function mstSystemMail()
    {
        return $this->belongsTo(MstSystemMail::class, 'mst_system_mail_id', 'id');
    }
}