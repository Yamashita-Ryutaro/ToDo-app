<?php

namespace App\Models\Task;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'folder_id',
        'title',
        'status_id',
        'due_date',
    ];

    /**
     * 日付フォーマットがYYYY-MM-DDT00:00:00.000000Z(ISO8601)なので、Y-m-d H:i:sに変更する
     *
     * @param   string           \DateTimeInterface $date   DateTime や DateTimeImmutable を引数や戻り値、プロパティの型宣言で使えるようにしたインターフェース
     * @return  Tasl $date       tasksテーブルの日時のフォーマット化
     *
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * タスクがフォルダに属しているか
     */
    public function isInFolder(Folder $folder): bool
    {
        return $this->folder_id === $folder->id;
    }

    /**
     * 
     */
    public function getStatusAttribute()
    {
        // リレーションから「name」カラム（または表示したい値）を返す
        return optional($this->taskStatus)->status;
    }

    public function getStatusColorClassAttribute()
    {
        // ステータス名やidで分岐
        switch ($this->status) {
            case '未着手':
                return 'label-danger'; // 赤
            case '着手中':
                return 'label-warning'; // 黄色
            case '完了':
                return 'label-success'; // 緑
            default:
                return 'label-default'; // グレー
        }
    }


    /**
     * taskテーブルとtask_statusテーブルのリレーション
     */
    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id', 'id');
    }

    /**
     * taskテーブルとfolderテーブルのリレーション
     */
    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id', 'id');
    }
}
