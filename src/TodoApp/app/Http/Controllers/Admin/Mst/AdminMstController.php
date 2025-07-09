<?php

namespace App\Http\Controllers\Admin\Mst;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMstController extends Controller
{
    public function showMstIndexPage()
    {
        return view('admin.mst.index');
    }

    public function showUserDetailPage()
    {
        return view('admin.mst.detail');
    }
}
