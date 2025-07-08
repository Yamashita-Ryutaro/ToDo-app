<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Folder\CreateFolder;
use App\Http\Requests\Folder\EditFolder;
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
    public function showCreateFolderForm()
    {
        return view('folders/create');
    }

    /**
     *  【フォルダ編集ページの表示機能】
     *
     *  GET /folders/{folder_id}/edit
     *  @param int $folder_id
     *  @return \Illuminate\View\View
     */
    public function showEditFolderForm(int $folder_id)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('view', $folder);

        $data = $this->folderService->showEditFolderFormDataById($folder);

        return view('folders/edit', $data);
    }

    /**
     *  【フォルダ削除ページの表示機能】
     *  機能：フォルダIDをフォルダ編集ページに渡して表示する
     *
     *  GET /folders/{folder_id}/delete
     *  @param int $folder_id
     *  @return \Illuminate\View\View
     */
    public function showDeleteFolderForm(int $folder_id)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('view', $folder);

        $data = $this->folderService->showDeleteFolderFormDataById($folder);
        return view('folders/delete', $data);
    }

    /**
     * フォルダの新規作成
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
                'folder_id' => $result,
            ]);
        }
    }

    /**
     *  【フォルダの編集機能】
     *
     *  POST /folders/{id}/edit
     *  @param int $folder_id
     *  @param EditTask $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function editFolder(int $folder_id, EditFolder $request)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('update', $folder);

        $validated_data = $request->validated();
        $result = $this->folderService->editFolder($folder, $validated_data);
        if ($result) {
            return redirect()->route('tasks.index', ['folder_id' => $folder_id]);
        } else {
            return redirect()->back();
        }
    }

    /**
     *  【フォルダの削除機能】
     *  機能：フォルダが削除されたらDBから削除し、フォルダ一覧にリダイレクトする
     *
     *  POST /folders/{folder_id}/delete
     *  @param int $folder_id
     *  @return RedirectResponse
     */
    public function deleteFolder(int $folder_id)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('delete', $folder);

        $result = $this->folderService->deleteFolder($folder);

        if ($result) {
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }
}
