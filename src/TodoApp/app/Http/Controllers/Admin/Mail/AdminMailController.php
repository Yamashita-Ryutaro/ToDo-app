<?php

namespace App\Http\Controllers\Admin\Mail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAdminMailRequest;
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

    /**
     * メール詳細ページを表示
     *
     * @param int $system_mail_id
     * @return \Illuminate\View\View
     */
    public function showMailDetailPage($system_mail_id)
    {
        // メール詳細ページのデータを取得
        $mail = $this->adminMailService->showMailDetailPageData($system_mail_id);
        return view('admin.mail.detail', $mail);
    }

    /**
     * メールの更新処理
     *
     * @param UpdateAdminMailRequest $request
     * @param int $system_mail_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMail(UpdateAdminMailRequest $request, $system_mail_id)
    {
        $validated_data = $request->validated();
        // メールの更新処理を実行
        $result = $this->adminMailService->updateMail($validated_data, $system_mail_id);

        if ($result['result']) {
            return redirect()->back()->with('success', 'メールの更新に成功しました');
        } else {
            return redirect()->back()->with('error', $result['message'] ?? 'メールの更新に失敗しました');
        }
    }
}
