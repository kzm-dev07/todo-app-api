<?php

declare(strict_types=1);

namespace KzmTodoApp\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

/**
 * 作業者Eloquentモデル
 *
 * @property int $id
 * @property string $worker_id 作業者ID
 * @property string $sub subject
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker whereSub($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker whereWorkerId($value)
 * @mixin \Eloquent
 */
class Worker extends Model
{
    use HasUlids;

    /**
     * 一意の識別子を受け取るカラムの取得
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['worker_id'];
    }
}
