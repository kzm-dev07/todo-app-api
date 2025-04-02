<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

/**
 * タスクEloquentモデル
 *
 * @property int $id
 * @property string $task_id タスクID
 * @property string $worker_id 作業者ID
 * @property string $title やること
 * @property int $isDone 達成済みフラグ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereIsDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentTask whereWorkerId($value)
 * @mixin \Eloquent
 */
class EloquentTask extends Model
{
    use HasUlids;

    protected $table = 'tasks';

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
