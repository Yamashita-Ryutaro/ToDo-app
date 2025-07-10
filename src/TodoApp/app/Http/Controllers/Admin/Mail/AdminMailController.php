<?php

namespace App\Http\Controllers\Admin\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Mail\AdminMailService;

class AdminMailController extends Controller
{
    protected $adminMailService;

    public function __construct(AdminMailService $adminMailService)
    {
        $this->adminMailService = $adminMailService;
    }
    /**
     * メール一覧ページを表示
     *
     * @return \Illuminate\View\View
     */
    public function showMailIndexPage()
    {
        // メール一覧ページのデータを取得
        $mails = $this->adminMailService->showMailIndexPageData();
        return view('admin.mail.index', $mails);
    }

    public function showMailDetailPage($system_mail_id)
    {
        // メール詳細ページのデータを取得
        $mail = $this->adminMailService->showMailDetailPageData($system_mail_id);
        return view('admin.mail.detail', $mail);
    }
}
