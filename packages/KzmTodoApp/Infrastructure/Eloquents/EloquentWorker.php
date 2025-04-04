<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Eloquents;

use Database\Factories\EloquentWorkerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use KzmTodoApp\Domain\Worker\Worker;

/**
 * 作業者Eloquentモデル
 *
 * @property int $id
 * @property string $worker_id 作業者ID
 * @property string $sub subject
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereSub($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EloquentWorker whereWorkerId($value)
 * @mixin \Eloquent
 */
class EloquentWorker extends Model
{
    use HasUlids, HasFactory;

    protected $table = 'workers';

    /**
     * モデルの新しいファクトリインスタンスの生成
     */
    protected static function newFactory()
    {
        return EloquentWorkerFactory::new();
    }

    /**
     * 一意の識別子を受け取るカラムの取得
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['worker_id'];
    }

    public function toDomain(): Worker
    {
        return new Worker(
            $this->worker_id,
            $this->sub,
        );
    }
}
