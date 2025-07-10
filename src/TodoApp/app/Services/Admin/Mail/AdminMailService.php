<?php

namespace App\Services\Admin\Mail;

use App\Models\Mail\MstSystemMail;
use App\Models\Mail\SystemMail;

class AdminMailService
{
    /** 
     * メール一覧ページのデータを取得
     * 
     * @return array
     */
    public function showMailIndexPageData()
    {
        $mails = MstSystemMail::all();
        return [
            'mails' => $mails,
        ];
    }

    /**
     * メール詳細ページのデータを取得
     *
     * @param int $system_mail_id
     * @return array
     */
    public function showMailDetailPageData($system_mail_id)
    {
        $mail = SystemMail::where('system_mail_id', $system_mail_id)
            ->with(['mstSystemMail'])
            ->first();
        return [
            'mail' => $mail,
        ];
    }

    /**
     * メールの更新処理
     *
     * @param array $validated_data
     * @param int $system_mail_id
     * @return array
     */
    public function updateMail($validated_data, $system_mail_id)
    {
        $mail = SystemMail::find($system_mail_id);
        if (!$mail) {
            return [
                'result' => false,
                'message' => 'メールが見つかりません',
            ];
        }

        // メールの更新処理を実行
        $mail->update($validated_data);
        return [
            'result' => true,
        ];
    }
}