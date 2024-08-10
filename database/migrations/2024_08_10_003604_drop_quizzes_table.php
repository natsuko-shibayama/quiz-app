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
        Schema::dropIfExists('quizzes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->comment('カテゴリーID');
            $table->text('question')->comment('クイズ問題');
            $table->text('answer')->comment('クイズ答え');
            $table->timestamps();
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onUpdate('cascade')
            ->onDelete('restrict');//cascadeにすると親ごと削除できるけど、子を消さないと親消せなくてもいいなら、restrictでOK

        });
    }
};
