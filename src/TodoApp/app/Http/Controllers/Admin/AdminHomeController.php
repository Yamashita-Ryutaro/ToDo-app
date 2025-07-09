<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    //
    public function showTopPage(Request $request)
    {
        // トップページを表示
        return redirect()->route('admin.user.index');
    }
}
