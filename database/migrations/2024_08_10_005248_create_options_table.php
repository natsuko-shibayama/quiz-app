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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz')
            ->constrained('quizzes') //quizzesテーブルのidと紐づける
            ->onUpdate('cascade') //親テーブルの情報が更新されたとき、同時に更新される
            ->onDelete('cascade') //親テーブルの情報が削除されたとき、同時に削除される
            ->comment('クイズID');
            $table->string('content')->comment('選択肢の文章');
            $table->smallInteger('is_correct')->comment('0:正解　1:不正解');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
