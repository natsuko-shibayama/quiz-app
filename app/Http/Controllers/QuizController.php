<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Models\Category;
use App\Models\Option;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * クイズ一覧画面
     */
    public function index()
    {
        // $quizzes = Quiz::get()->toArray();
        // return view('quizzes.index', compact('quizzes'));
    }


    /**
     * クイズ新規登録画面
     */
    public function create(Request $request, int $categoryId)
    {
        // dd($categoryId, $request);
        return view('admin.quizzes.create' , [
            'categoryId' => $categoryId
        ]);
        // $category = Category::findOrFail((int)$request->category_id);//文字列だから数値に変換
        // return view('quizzes.create', compact('category'));
    }

    /**
     * クイズ新規登録処理
     */
    public function store(StoreQuizRequest $request, int $categoryId)
    {
        //  dd($categoryId, $request);
        // 先にクイズを登録する
        $quiz = new Quiz();
        $quiz->category_id = $categoryId;
        $quiz->question = $request->question;
        $quiz->explanation = $request->explanation;
        $quiz->save();


        // optionsの配列を２次元配列で定義して、この下で繰り返しでそれぞれのカラムを定義してsaveしていくように書く
        $options = [
            ['quiz_id' => $quiz->id,'content' => $request->content1,'is_correct' => $request->isCorrect1],
            ['quiz_id' => $quiz->id,'content' => $request->content2,'is_correct' => $request->isCorrect2],
            ['quiz_id' => $quiz->id,'content' => $request->content3,'is_correct' => $request->isCorrect3],
            ['quiz_id' => $quiz->id,'content' => $request->content4,'is_correct' => $request->isCorrect4]
        ];
        // optionsの中の繰り返し
        foreach($options as $option){
            $newOption = new Option();
            $newOption->quiz_id = $option['quiz_id'];
            $newOption->content = $option['content'];
            $newOption->is_correct = $option['is_correct'];
            $newOption->save();
        }

        return redirect()->route('admin.categories.show', ['categoryId' => $categoryId]);

        // // インスタンス作成
        // $quiz = new Quiz;
        // // 各項目の処理を記載
        // $quiz->category_id = (int)$request->category_id;
        // $quiz->question = $request->question;
        // $quiz->answer = $request->answer;
        // // 保存
        // $quiz->save();

        // // storeメソッドはrouteでなくてredirect
        // return redirect()->route('categories.show', (int)$request->category_id);

    }

    /**
     * クイズ詳細
     * categoryに紐づいたquizのページに遷移して詳細がみられるようにする
     */
    public function show(Request $request)
    {
        // // categoryと紐づけてクイズを取得→withを使う
        // $quiz = Quiz::with('category')->find($request->quiz_id);

    }
    /**
     * クイズ編集画面表示
     * categoryに紐づいたquizのページに遷移して編集ができるようにする
     */
    public function edit(Request $request, int $categoryId ,int $quizId)
    {
        // dd('$categoryId',$categoryId, 'quizId', $quizId, $request);
        $quiz = Quiz::with('category', 'options')->findOrFail($quizId);
        // dd($quiz->options);
        return view('admin.quizzes.edit', [
            'category' => $quiz->category,
            'quiz' => $quiz,
            'options' => $quiz->options,
        ]);
    }

    // クイズ更新処理
    public function update(UpdateQuizRequest $request, int $categoryId, int $quizId)
    {
        // dd('$categoryId',$categoryId, 'quizId', $quizId, $request);
        // Quizの更新
        $quiz = Quiz::findOrFail($quizId);
        $quiz->question = $request->question;
        $quiz->explanation = $request->explanation;
        $quiz->save();
        // Optionの更新
        // $option1 = Option::findOrFail((int)$request->optionId1);
        // $option1->content = $request->content1;
        // $option1->is_correct = $request->isCorrect1;
        // $option1->save();
        // $option2 = Option::findOrFail((int)$request->optionId2);
        // $option2->content = $request->content2;
        // $option2->is_correct = $request->isCorrect2;
        // $option2->save();
        // $option3 = Option::findOrFail((int)$request->optionId3);
        // $option3->content = $request->content3;
        // $option3->is_correct = $request->isCorrect3;
        // $option3->save();
        // $option4 = Option::findOrFail((int)$request->optionId4);
        // $option4->content = $request->content4;
        // $option4->is_correct = $request->isCorrect4;
        // $option4->save();

        // 上のリファクタリング
        $options = [
            ['optionId' => (int)$request->optionId1, 'content' => $request->content1, 'is_correct' => $request->isCorrect1 ],
            ['optionId' => (int)$request->optionId2, 'content' => $request->content2, 'is_correct' => $request->isCorrect2 ],
            ['optionId' => (int)$request->optionId3, 'content' => $request->content3, 'is_correct' => $request->isCorrect3 ],
            ['optionId' => (int)$request->optionId4, 'content' => $request->content4, 'is_correct' => $request->isCorrect4 ],
        ];
        // optionsの繰り返し
        foreach($options as $option){
            $updateOption = Option::findOrFail($option['optionId']);
            $updateOption->content = $option['content'];
            $updateOption->is_correct = $option['is_correct'];
            $updateOption->save();
        }
        // カテゴリー詳細画面にリダイレクト
        return redirect()->route('admin.categories.show', ['categoryId' => $categoryId, 'quizId' =>  $quizId ]);

    }
    // クイズ削除機能
    public function destroy(Request $request, int $categoryId ,int $quizId)
    {
        // dd('$categoryId',$categoryId, 'quizId', $quizId, $request);
        $quiz = Quiz::findOrFail($quizId);
        $quiz->delete();
        // カテゴリー詳細画面にリダイレクト
        return redirect()->route('admin.categories.show', ['categoryId' => $categoryId, 'quizId' =>  $quizId ]);

    }

}
