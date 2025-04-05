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
            $table->ulid('key')->unique()->comment('タスクキー');
            $table->ulid('worker_key')->comment('作業者キー');
            $table->string('title', 255)->comment('タイトル');;
            $table->boolean('isDone')->default(false)->comment('達成済みフラグ');;
            $table->timestamps();

            $table->foreign(['worker_key'], 'fk_workers')
                ->references(['key'])
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
