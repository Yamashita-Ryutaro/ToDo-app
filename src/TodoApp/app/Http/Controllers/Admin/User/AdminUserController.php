<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //
    public function showUserIndexPage()
    {
        return view('admin.user.index');
    }

    public function showUserDetailPage()
    {
        return view('admin.user.detail');
    }
}
