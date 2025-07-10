<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\User\AdminUserService;

class AdminUserController extends Controller
{
    protected $adminUserService;

    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    /**
     * ユーザー一覧ページを表示
     *
     * @return \Illuminate\View\View
     */
    public function showUserIndexPage()
    {
        // ユーザー一覧ページのデータを取得
        $users = $this->adminUserService->showUserIndexPageData();
        return view('admin.user.index', $users);
    }

    /**
     * ユーザー詳細ページを表示
     *
     * @param int $user_id
     * @return \Illuminate\View\View
     */
    public function showUserDetailPage($user_id)
    {
        // ユーザー詳細ページのデータを取得
        $user = $this->adminUserService->showUserDetailPageData($user_id);
        return view('admin.user.detail', $user);
    }
}
