<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Registered;

class UserService
{
    /**
     * ユーザー仮登録
     * 
     * @param array $validated_data
     * @return bool
     */
    public function preRegisterNewUser($validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            User::create([
                'email' => $validated_data['email'],
                'name' => $validated_data['name'],
                'password' => Hash::make($validated_data['password']),
            ]);
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('ユーザー登録: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;
    }

    /**
     * ユーザー本登録
     */
    public function registerNewUser($validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('ユーザー登録: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;        
    }


    /**
     * ユーザーログイン
     * 
     * @param array $validated_data
     * @return int $user_id
     */
    public function loginUser($validated_data)
    {
        // attemptは true/false を返す
        if (Auth::attempt([
            'email' => $validated_data['email'],
            'password' => $validated_data['password']
        ])) {
            // 認証に成功したらユーザーIDなど取得できる
            return Auth::id(); // または Auth::user()
        }
        return null;
    }

    /**
     * ユーザーログアウト処理
     * 
     * @return bool $result
     */
    public function logoutUser()
    {
        $result = false;
        try {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        } catch (\Exception $e) {
            Log::error('ログアウト: ' . $e->getMessage());
        }
        return $result;
    }

    /**
     * パスワードリセット処理
     * 
     * @param array $validated_data
     * @return bool $result
     */
    public function resetPassword($validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $user = User::where('email', $validated_data['email'])->first();
            $user->update([
                'password' => Hash::make($validated_data['password']),
            ]);
            PasswordReset::where('email', $validated_data['email'])->delete();
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('パスワードリセット: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;
    }
}