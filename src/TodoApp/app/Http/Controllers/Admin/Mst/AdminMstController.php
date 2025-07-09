<?php

namespace App\Http\Controllers\Admin\Mst;

use App\Http\Controllers\Controller;
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
        return view('admin.mst.detail', $table);
    }
}
