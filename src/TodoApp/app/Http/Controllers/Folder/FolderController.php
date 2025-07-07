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
     *  GET /folders/{id}/edit
     *  @param int $id
     *  @return \Illuminate\View\View
     */
    public function showEditFolderForm(int $id)
    {
        $folder = $this->folderService->showEditFolderFormDataById($id);

        return view('folders/edit', $folder);
    }

    /**
     *  【フォルダ削除ページの表示機能】
     *  機能：フォルダIDをフォルダ編集ページに渡して表示する
     *
     *  GET /folders/{id}/delete
     *  @param int $id
     *  @return \Illuminate\View\View
     */
    public function showDeleteFolderForm(int $id)
    {
        $folder = $this->folderService->showDeleteFolderFormDataById($id);
        return view('folders/delete', $folder);
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
                'id' => $result,
            ]);
        }
    }

    /**
     *  【フォルダの編集機能】
     *
     *  POST /folders/{id}/edit
     *  @param int $id
     *  @param EditTask $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function editFolder(int $id, EditFolder $request)
    {
        $validated_data = $request->validated();
        $result = $this->folderService->editFolder($id, $validated_data);
        if ($result) {
            return redirect()->route('tasks.index', ['id' => $id]);
        } else {
            return redirect()->back();
        }
    }

    /**
     *  【フォルダの削除機能】
     *  機能：フォルダが削除されたらDBから削除し、フォルダ一覧にリダイレクトする
     *
     *  POST /folders/{id}/delete
     *  @param int $id
     *  @return RedirectResponse
     */
    public function deleteFolder(int $id)
    {
        $result = $this->folderService->deleteFolder($id);

        if ($result) {
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }
}
