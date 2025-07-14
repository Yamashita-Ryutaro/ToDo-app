<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\MstAdmin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Folder;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_get_notification',
        'password',
        'admin_id',
        'user_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAdminAttribute()
    {
        return optional($this->mstAdmin)->display_name;
    }

    /*
    * ユーザークラスの関係性を辿ってフォルダークラスのリストを取得する
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function folders()
    {
        return $this->hasMany(Folder::class, 'user_id', 'id');
    }

    public function mstAdmin()
    {
        return $this->belongsTo(MstAdmin::class, 'admin_id', 'id');
    }
}