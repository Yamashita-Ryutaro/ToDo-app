<?php

namespace App\Http\Controllers\Admin\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMailController extends Controller
{
    public function showFailIndexPage()
    {
        return view('admin.mail.index');
    }

    public function showUserDetailPage()
    {
        return view('admin.mail.detail');
    }
}
