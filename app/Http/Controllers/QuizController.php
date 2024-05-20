<?php

namespace App\Http\Controllers;

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
        return view('quizzes.create');
    }

    /**
     * クイズ新規登録処理
     */
}
