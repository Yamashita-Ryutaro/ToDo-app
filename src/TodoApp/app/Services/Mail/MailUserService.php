<?php

namespace App\Services\Mail;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class MailUserService
{
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
}