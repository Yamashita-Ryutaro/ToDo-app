<?php

namespace App\Services\Admin\User;

use App\Models\User;

class AdminUserService
{
    /**
     * ユーザー一覧ページのデータを取得
     *
     * @return array
     */
    public function showUserIndexPageData()
    {
        $users = User::all();
        // ユーザー一覧ページに必要なデータを整形して返す
        return [
            'users' => $users,
        ];
    }

    /**
     * ユーザー詳細ページのデータを取得
     *
     * @param int $user_id
     * @return array
     */
    public function showUserDetailPageData($user_id)
    {
        $user = User::with('folders')->find($user_id);

        return [
            'user' => $user,
            'folders' => $user->folders,
        ];
    }   
}