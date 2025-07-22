<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstSystemMailKey extends Model
{
    use HasFactory;

    protected $table = 'mst_system_mail_keys';

    protected $fillable = [
        'display_name',
        'key',
    ];
}
