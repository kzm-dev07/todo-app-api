<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Eloquents;

use Database\Factories\EloquentTaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * タスクEloquentモデル
 *
 * @property int $id
 * @property string $key タスクキー
 * @property string $worker_key 作業者キー
 * @property string $title タイトル
 * @property int $isDone 達成済みフラグ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\EloquentTaskFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereIsDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereWorkerKey($value)
 * @mixin \Eloquent
 */
class EloquentTask extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    /**
     * モデルの新しいファクトリインスタンスの生成
     */
    protected static function newFactory()
    {
        return EloquentTaskFactory::new();
    }

    /**
     * 一意の識別子を受け取るカラムの取得
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['task_id'];
    }
}
