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
        'url_key',
        'action_text',
        'notification_id',
    ];

    public function mstNotification()
    {
        return $this->belongsTo(MstNotification::class, 'notification_id');
    }
}
