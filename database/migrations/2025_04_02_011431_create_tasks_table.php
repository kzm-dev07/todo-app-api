<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->comment('タスク');
            $table->id();
            $table->ulid('task_id')->unique()->comment('タスクID');
            $table->ulid('worker_id')->comment('作業者ID');
            $table->string('title', 255)->comment('やること');;
            $table->boolean('isDone')->default(false)->comment('達成済みフラグ');;
            $table->timestamps();

            $table->foreign(['worker_id'], 'fk_workers')
                ->references(['worker_id'])
                ->on('workers')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
