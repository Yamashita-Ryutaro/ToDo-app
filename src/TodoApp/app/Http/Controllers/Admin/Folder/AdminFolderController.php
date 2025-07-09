<?php

namespace App\Http\Controllers\Admin\Folder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminFolderController extends Controller
{
    public function showFolderIndexPage()
    {
        return view('admin.folder.index');
    }

    public function showUserDetailPage()
    {
        return view('admin.folder.detail');
    }
}
