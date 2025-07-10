<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserService
{
    /**
     * ユーザー仮登録
     * 
     * @param array $validated_data
     * @return array [result, message]
     */
    public function preRegisterNewUser($validated_data)
    {
        $result = false;
        $message = '';
        DB::beginTransaction();
        try {
            // 既に本登録済みユーザーがいたら弾く
            $alreadyRegistered = User::where('email', $validated_data['email'])
                ->whereNotNull('email_verified_at')
                ->exists();

            if ($alreadyRegistered) {
                $message = '既に本登録済みのメールアドレスです。';
                return [
                    'result' => false,
                    'message' => $message,
                ];
            }

            // 既存の未本登録ユーザーを検索
            $user = User::where('email', $validated_data['email'])
                ->whereNull('email_verified_at') // 本登録完了判定
                ->first();

            $token = Str::random(60);

            if ($user) {
                // 仮登録中の場合は情報を上書き
                $user->update([
                    'name' => $validated_data['name'],
                    'password' => Hash::make($validated_data['password']),
                    'user_token' => $token,
                ]);
            } else {
                // 新規ユーザー登録
                $user = User::create([
                    'email' => $validated_data['email'],
                    'name' => $validated_data['name'],
                    'password' => Hash::make($validated_data['password']),
                    'user_token' => $token,
                ]);
            }

            // 仮登録メールを送信
            $user->sendPreRegisterNewUserNotification($token);
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('ユーザー登録: ' . $e->getMessage());
            DB::rollBack();
        }
        return [
            'result' => $result,
            'message' => $message,
        ];
    }

    /**
     * ユーザー本登録
     * 
     * @param string $user_token
     * @return array [result, message]
     */
    public function registerNewUser($user_token)
    {
        $result = false;
        $message = '';
        DB::beginTransaction();
        try {
            $user = User::where('user_token', $user_token)->first();

            // ユーザーが見つからない場合
            if (!$user) {
                $message = '無効な登録トークンです。';
                return [
                    'result' => false,
                    'message' => $message,
                ];
            }

            // すでに本登録済みの場合は処理をスキップ
            if ($user->email_verified_at) {
                $message = 'このユーザーはすでに本登録済みです。';
                return [
                    'result' => false,
                    'message' => $message,
                ];
            }

            $user->update([
                'email_verified_at' => now(), // 仮登録から本登録へ
            ]);
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('ユーザー登録: ' . $e->getMessage());
            DB::rollBack();
        }
        return [
            'result' => $result,
            'message' => $message,
        ];        
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
     * パスワードリセットメール
     * 
     * @param array $validated_data
     * @return bool $result
     */
    public function sentPasswordEmail($validated_data)
    {
        $result = false;
        try {
            $email = $validated_data['email'];
            Password::sendResetLink(['email' => $email]);
            $result = true;
        } catch (\Exception $e) {
            Log::error('パスワードリセットメール: ' . $e->getMessage());
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