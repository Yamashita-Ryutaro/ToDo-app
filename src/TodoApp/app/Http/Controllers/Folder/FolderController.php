<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Folder\CreateFolder;
use App\Services\Folder\FolderService;

class FolderController extends Controller
{
    protected $folderService;

    public function __construct(FolderService $folderService)
    {
        $this->folderService = $folderService;
    }

    /**
     * フォルダ作成ページの表示
     * 
     * @return \Illuminate\View\View
     */
    public function showCreateForm()
    {
        return view('folders/create');
    }

    /**
     * 
     * @param CreateFolder $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createNewFolder(CreateFolder $request)
    {
        $validated_data = $request->validated();
        $result = $this->folderService->createNewFolder($validated_data);

        if($result === false) {
            return back()->with('errors', 'フォルダ作成に失敗');
        } else {
            return redirect()->route('tasks.index', [
                'id' => $result,
            ]);
        }
    }
}
