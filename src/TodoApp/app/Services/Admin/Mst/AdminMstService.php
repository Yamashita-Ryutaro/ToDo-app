<?php

namespace App\Services\Admin\Mst;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use App\Models\Admin\MstTables;
use App\Models\Admin\MstAdmin;

class AdminMstService
{
    public function showMstIndexPageData()
    {
        $mstTables = MstTables::all();
        
        return [
            'tables' => $mstTables,
        ];
    }

    public function showMstDetailPageData($table_name)
    {

    }
}