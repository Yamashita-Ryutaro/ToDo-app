<?php

namespace App\Services\Admin\User;

use App\Models\User;

class AdminUserService
{
    /**
     * ユーザー一覧ページのデータを取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
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
     * @return \App\Models\User|null
     */
    public function showUserDetailPageData($user_id)
    {
        $user = User::find($user_id);
        $folders = $user->folders;
        return [
            'user' => $user,
            'folders' => $folders,
        ];
    }   
}