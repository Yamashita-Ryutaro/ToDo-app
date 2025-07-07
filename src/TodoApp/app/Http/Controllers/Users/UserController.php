<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function showLoginPage()
    {
        return view('user.login');
    }

    public function showRegisterPage()
    {
        return view('user.register');
    }
}