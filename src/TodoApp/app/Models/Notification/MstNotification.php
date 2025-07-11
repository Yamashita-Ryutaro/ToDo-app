<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstNotification extends Model
{
    use HasFactory;
    protected $table = 'mst_notifications';
    protected $fillable = [
        'display_name',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'notification_id');
    }
}
