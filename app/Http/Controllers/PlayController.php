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

        // セッションの削除
        session()->forget("resultArray");
        $category = Category::withCount('quizzes')->findOrFail($categoryId);
        // dd($category->quizzes_count);
        return view('play.start', [
            'category' => $category,
            'quizzesCount' => $category->quizzes_count
        ]);
    }

    // クイズ出題画面
    public function quizzes(Request $request, int $categoryId)
    {
        // $category = Category::findOrFail($categoryId);
        // dd('$category', $category);ここまでの2行でDBに２回アクセスしてる。ダメ。
        // カテゴリーに紐づくクイズと選択肢を全て取得する
        $category = Category::with('quizzes.options')->findOrFail($categoryId);//Eager（熱心な）ロードー事前に読み込んでおく


        $resultArray = session(('resultArray'));
        // 初回アクセス時はセッションに保存されたクイズIDの配列がないため（null)、クイズIDの配列を作成
        if(is_null($resultArray)){
            $resultArray = $this->setResultArrayForSession($category);
            session(['resultArray' => $resultArray]);
        }

        // $resultArrayの中でresultがnullのもののうち、最初のデータを選ぶ
        $noAnswerResult = collect($resultArray)->filter(function($item){
            return $item['result'] === null;
        })->first();

        if(!$noAnswerResult){
            // 全てのクイズに解答済みの場合はレザルト画面にりだいれくと
            return redirect()->route('categories.quizzes.result' ,['categoryId' => $categoryId]);
            // dd('未解答のクイズはなくなりました');
        };

        $quiz = $category->quizzes->firstWhere('id',$noAnswerResult['quizId'])->toArray();
        // dd(session('resultArray'));
        // クイズをランダムに選ぶ
        // $quizzes = $category->quizzes->toArray();
        // shuffle($quizzes);
        // $quiz = $quizzes[0];
        return view('play.quizzes',[
            'categoryId' => $categoryId,
            'quiz' => $quiz
        ]);
    }

    // クイズ解答画面
    public function answer(Request $request, int $categoryId)
    {
        $quizId = $request->quizId;
        $selectedOptions = $request->optionId === null ? [ ]: $request->optionId;//nullの場合は空の配列を返す
        $category = Category::with('quizzes.options')->findOrFail($categoryId);
        $quiz = $category->quizzes->firstWhere('id', $quizId);
        // dd($quizId, $selectedOptions, $quiz);
        $quizOptions = $quiz->options->toArray();
        // dd($selectedOptions);
        $isCorrectAnswer = $this->isCorrectAnswer($selectedOptions, $quizOptions);

        // セッションからクイズIDと解答情報を取得
        $resultArray = session('resultArray');
        // 解答結果をセッションに保存する
        foreach($resultArray as $index => $result){
            if($result['quizId'] === (int)$quizId){
                $resultArray[$index]['result'] = $isCorrectAnswer;
                break;
            }
        }
        // 解答結果をセッションに保存(上書き）する
        session(['resultArray' => $resultArray]);
        return view('play.answer', [
            'isCorrectAnswer' => $isCorrectAnswer,
            'quiz' => $quiz->toArray(),
            'quizOptions' => $quizOptions,
            'selectedOptions' => $selectedOptions,
            'categoryId' => $categoryId

        ]);
    }


    // リザルト画面表示
    public function result(Request $request, int $categoryId)
    {
        // dd($categoryId, $request);
        $resultArray = session('resultArray');
        $questionCount = count($resultArray);
        $correctCount = collect($resultArray)->filter(function($result){
            return $result['result'] === true;
        })->count();
        return view('play.result', [
            'categoryId' => $categoryId,
            'questionCount' => $questionCount,
            'correctCount' => $correctCount
        ]);
    }

    // 初回の時にセッションにクイズのIDと解答状況を保存する
    private function setResultArrayForSession(Category $category)
    {
        // クイズIDを全て抽出する
        $quizIds = $category->quizzes->pluck('id')->toArray();
        // クイズIDの配列をランダムに入れ替える
        shuffle($quizIds);
        $resultArray = [];
        foreach($quizIds as $quizId){
            $resultArray[] = [
                'quizId' => $quizId,
                'result' => null
            ];
        }
        return $resultArray;
    }




    // プレイヤーの解答が正解か不正解かを判定→このファイル内でしか呼ばれないから、privateでOK。クラスの中にあるから、$thisで呼べる。
    private function isCorrectAnswer(array $selectedOptions, array $quizOptions)
    {
        // dd('isCorrectAnswer',$selectedOptions, $quizOptions);
        //クイズの選択肢から正解の選択肢を抽出し、そのidを全て取得する
        $correctOptions = array_filter($quizOptions, function($option){
            return $option['is_correct'] === 1;
        });

        // idの数字だけを抽出する
        $correctOptionIds =  array_map(function($option){
            return $option['id'];
        }, $correctOptions);

        // dd($selectedOptions, $correctOptions, $correctOptionIds);
        // dd($correctOptions, $quizOptions);
        //プレイヤーが選んだ選択肢の個数と正解の選択肢の工数が一致するかを判定する
        if(count($selectedOptions) !== count($correctOptionIds)){
            return false;
        }
        // dd('falseではなかった');
        //プレイヤーが選んだ選択肢のid番号と正解のidが全て一致することを判定する
        foreach($selectedOptions as $selectedOption){
            if(!in_array((int)$selectedOption, $correctOptionIds)){
                return false;
            }
        }
        // 正解であることを返す
        return true;
    }

}
