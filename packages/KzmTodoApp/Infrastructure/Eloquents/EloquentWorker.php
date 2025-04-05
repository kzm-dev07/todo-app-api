<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Eloquents;

use Database\Factories\EloquentWorkerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use KzmTodoApp\Domain\Worker\Worker;

/**
 * 作業者Eloquentモデル
 *
 * @property int $id
 * @property string $key 作業者キー
 * @property string $sub subject
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\EloquentWorkerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereSub($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EloquentWorker extends Model
{
    use HasFactory;

    protected $table = 'workers';

    /**
     * モデルの新しいファクトリインスタンスの生成
     */
    protected static function newFactory()
    {
        return EloquentWorkerFactory::new();
    }

    public function toDomain(): Worker
    {
        return new Worker(
            $this->worker_id,
            $this->sub,
        );
    }
}
