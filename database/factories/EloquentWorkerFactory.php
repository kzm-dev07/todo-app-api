<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KzmTodoApp\Infrastructure\Eloquents\EloquentWorker;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EloquentWorkerFactory extends Factory
{

    /**
     * モデルに対応するファクトリ名
     *
     * @var class-string<\KzmTodoApp\Infrastructure\Eloquents\EloquentWorker>
     */
    protected $model = EloquentWorker::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sub' => Uuid::uuid4()->toString(),
        ];
    }
}
