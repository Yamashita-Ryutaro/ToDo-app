<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    public $timestamps = false; // このテーブルにはcreated_at/updated_atが無い
    protected $table = 'password_resets';
    protected $fillable = ['email', 'token', 'created_at'];
}
