<?php

namespace App\Http\Controllers\Admin\Mst;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAdminMstRequest;
use App\Http\Requests\Admin\UpdateAdminNotificationMstRequest;
use Illuminate\Http\Request;
use App\Services\Admin\Mst\AdminMstService;

class AdminMstController extends Controller
{
    protected $adminMstService;

    public function __construct(AdminMstService $adminMstService)
    {
        $this->adminMstService = $adminMstService;
    }

    /**
     * マスタテーブル一覧ページを表示
     * 
     * @return \Illuminate\View\View
     */
    public function showMstIndexPage()
    {
        $tables = $this->adminMstService->showMstIndexPageData();
        return view('admin.mst.index', $tables);
    }

    /**
     * マスタテーブル詳細ページを表示
     * 
     * @param string $table_name
     * @return \Illuminate\View\View
     */
    public function showMstDetailPage($table_name)
    {
        $table = $this->adminMstService->showMstDetailPageData($table_name);
        if ($table_name === 'mst_notifications') {
            return view('admin.mst.notification.detail', $table);
        }

        return view('admin.mst.detail', $table);
    }

    /**
     * マスタテーブル詳細を更新
     * 
     * @param Request $request
     * @param string $table_name
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMstDetail(UpdateAdminMstRequest $request, $table_name)
    {
        $validated_data = $request->validated();
        $result = $this->adminMstService->updateMstDetail($validated_data, $table_name);

        if ($result['result']) {
            return redirect()->route('admin.mst.detail', $table_name)->with('success', '更新しました');
        } else {
            return redirect()->route('admin.mst.detail', $table_name)->with('error', $result['message'] ?? '更新に失敗しました');
        }
    }

    /**
     * 通知機能のマスタテーブル詳細ページの更新
     * 
     * @param UpdateAdminNotificationMstRequest $request
     * @param string $table_name
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateNotificationMstDetail(UpdateAdminNotificationMstRequest $request)
    {
        $validated_data = $request->validated();
        $result = $this->adminMstService->updateNotificationMstDetail($validated_data);

        if ($result['result']) {
            return redirect()->back()->with('success', '更新しました');
        } else {
            return redirect()->back()->with('error', $result['message'] ?? '更新に失敗しました');
        }
    }
}
