<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTaskController extends Controller
{
    public function showTaskIndexPage()
    {
        return view('admin.task.index');
    }

    public function showUserDetailPage()
    {
        return view('admin.task.detail');
    }
}
