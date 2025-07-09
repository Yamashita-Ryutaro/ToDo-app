<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstAdmin extends Model
{
    use HasFactory;

    protected $table = 'mst_admin';
    protected $primaryKey = 'id';
}
