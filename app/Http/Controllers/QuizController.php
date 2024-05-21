<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizRequest;
use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * クイズ一覧画面
     */
    public function index()
    {
        $quizzes = Quiz::get()->toArray();
        return view('quizzes.index', compact('quizzes'));
    }


    /**
     * クイズ新規登録画面
     */
    public function create(Request $request)
    {
        $category = Category::findOrFail((int)$request->category_id);//文字列だから数値に変換
        return view('quizzes.create', compact('category'));
    }

    /**
     * クイズ新規登録処理
     */
    public function store(StoreQuizRequest $request)
    {
        // インスタンス作成
        $quiz = new Quiz;
        $quiz->category_id = (int)$request->category_id;
        $quiz->question = $request->question;
        $quiz->answer = $request->answer;
        $quiz->save();

        return redirect()->route('categories.show', (int)$request->category_id);

    }
}
