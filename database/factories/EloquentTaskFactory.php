<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KzmTodoApp\Domain\Common\Key;
use KzmTodoApp\Infrastructure\Eloquents\EloquentTask;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EloquentTaskFactory extends Factory
{

    /**
     * モデルに対応するファクトリ名
     *
     * @var class-string<\KzmTodoApp\Infrastructure\Eloquents\EloquentTask>
     */
    protected $model = EloquentTask::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => Key::generate()->toString(),
            'worker_key' => Key::generate()->toString(),
            'title' => '筋トレ',
            'isDone' => false,
        ];
    }
}
