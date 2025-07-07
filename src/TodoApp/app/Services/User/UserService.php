<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * ユーザー登録
     * 
     * @param array $validated_data
     * @return bool
     */
    public function registerNewUser($validated_data)
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
}