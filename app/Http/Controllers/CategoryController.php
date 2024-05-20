<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    /**
     * category一覧
     */
    public function index()
    {
        $categories = Category::get()->toArray();
        $errors = session('errors') ? session('errors')->toArray() : [];
        return view('categories.index', compact('categories', 'errors'));
    }

    /**
     * category新規登録画面
     */
    public function create(Request $request){
        return view('categories.create');
    }



    /**
     * category新規登録処理
     */
    public function store(Request $request)
    {
        $validator = $this->validateName($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        //categoryモデルのインスタンス作成
        $category = new Category;
        //categoryインスタンスのnameプロパティに$request->nameを代入
        $category->name = $request->name;
        $category->description = $request->description;
        //saveメソッドでcategoryを保存
        $category->save();
        //category一覧へ遷移
        return view(route('categories.index'));
    }

    /**
     * category詳細画面
     */
    public function show(Request $request)
    {
        $category = Category::findOrFail($request->category);
        return view('categories.show', compact('category'));
    }
    /**
     * category編集画面
     */
    public function edit(Request $request)
    {
        $category = Category::findOrFail($request->category);
        $errors = session('errors') ? session('errors')->toArray() : [];
        return view('categories.show', compact('category', 'errors'));
    }
    /**
     * category更新処理
     */
    public function update(Request $request)
    {
        $validator = $this->validateName($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $category = Category::findOrFail($request->category);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        $errors = session('errors') ? session('errors')->toArray() : [];
        return view('categories.show', compact('category', 'errors'));

        // 困ったらこれで確認
        // $validator->errors()->all()
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
