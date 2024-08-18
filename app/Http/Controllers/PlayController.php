<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class PlayController extends Controller
{

    // プレイ画面のトップページ
    public function top()
    {
        $categories = Category::all();
        // dd($categories);
        return view("play.top", [
            "categories" => $categories
        ]);
    }

    // クイズスタート画面表示
    public function categories(Request $request, int $categoryId)
    {
        // dd($categoryId, $request);
        $category = Category::withCount('quizzes')->findOrFail($categoryId);
        dd($category->quizzes_count);
        return view('play.start', [
            'category' => $category,
            'quizzesCount' => $category->quizzes_count
        ]);
    }
}
