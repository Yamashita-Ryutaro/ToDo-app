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
}