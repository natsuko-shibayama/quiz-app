<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    /**
     * category一覧　兼　管理画面トップページ
     */
    public function top()
    {
        // カテゴリー一覧を取得
        $categories = Category::get();
        // dd($categories);
        return view('admin.top' , [
            'categories' => $categories
        ]);
    }

    /**
     * category新規登録画面表示
     */
    // public function create(Request $request){
    public function create(){
        // return view('categories.create');
        return view('admin.categories.create');
    }



    /**
     * category新規登録処理
     */
    // public function store(Request $request)
    public function store(StoreCategoryRequest $request)
    {
        // dd('カテゴリー新規登録処理のルートです',$request);

        // $validator = $this->validateName($request);
        // if($validator->fails()){
        //     return back()->withErrors($validator)->withInput();
        // }
        //categoryモデルのインスタンス作成
        $category = new Category;
        //categoryインスタンスのnameプロパティに$request->nameを代入
        $category->name = $request->name;
        $category->description = $request->description;
        //saveメソッドでcategoryを保存
        $category->save();
        //category一覧へ遷移
        return redirect()->route('admin.top');
    }

    /**
     * category詳細画面表示
     */
    public function show(Request $request , int $categoryId)
    {
        // dd($categoryId, $request);
        $category = Category::findOrFail($categoryId);
        return view('admin.categories.show' , [
            'category' => $category
        ]);
    //     // $quizzes = Category::find($request->category)->quizzes;
    //     // // findの引数はPK
    //     // return view('categories.show', compact('category', 'quizzes'));
    }
    /**
     * category編集画面表示
     */
    public function edit(Request $request , int $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('admin.categories.edit' , [
            'category' => $category
        ]);
        // $category = Category::findOrFail($request->category);
        // $errors = session('errors') ? session('errors')->toArray() : [];
        // return view('categories.show', compact('category', 'errors'));
    }
    /**
     * category更新処理
     */
    public function update(UpdateCategoryRequest $request , int $categoryId)
    {
        // dd($categoryId, $request);
        $category = Category::findOrFail($categoryId);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        // $errors = session('errors') ? session('errors')->toArray() : [];
        return redirect()->route('admin.categories.show', ['categoryId' => $categoryId]);

        // 困ったらこれで確認
        // $validator->errors()->all()
    }

    /**
     * category削除処理
     */
    public function destroy(Request $request , int $categoryId)
    {
        // dd($categoryId, $request);
        $category = Category::findOrFail($categoryId);
        $category->delete();
        // // $errors = session('errors') ? session('errors')->toArray() : [];
        return redirect()->route('admin.top');
    }



    /**
     * バリデーション
     */

    private function validateName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:categories', 'max:20'],
            'description' => ['required', 'string', 'max:2000']
        ]);

        return $validator;
    }

}
