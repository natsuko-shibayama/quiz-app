<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>カテゴリ編集</title>
  <style>
    .category_name{
      font-size: 24px;
      font-weight: bold;
      color: coral;
    }
    .return_btn{
      display: block;
      width: 100px;
      padding: 10px;
      background-color: cadetblue;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 4px;
      margin-bottom: 5px;

    }
    .return_btn:hover{
      color: black;
      background-color: #fff;
      border: 1px solid black;
    }
    .quiz_btn{
      display: block;
      width: 160px;
      padding: 10px;
      background-color:blue;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 4px;

    }
    .quiz_btn:hover{
      color: black;
      background-color: #fff;
      border: 1px solid black;
    }
    .is_edit{
      pointer-events: none;
    }
    .edit_btn{
      cursor: pointer;
      visibility: visible;
      display: block;
      width: 100px;
      padding: 10px;
      background-color:coral;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 4px;
      border-color: coral;
      margin-bottom: 5px;
    }
    .edit_input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 10px;
      opacity: 0.5;
    }
    .edit_textarea {
      width: 100%;
      height: 150px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 10px;
      opacity: 0.5;
    }
    .update_btn{
      width: 100px;
      padding: 10px;
      background-color:coral;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 4px;
      border-color: coral;
      margin-bottom: 5px;
      display: none;
      pointer-events: auto;
    }
    .update_btn:hover{
      color: black;
      background-color: #fff;
      border: 1px solid black;
    }
    .category_detail_title{
      font-size: 24px;
      font-weight: bold;
    }
    .quiz_index_title{
      font-size: 24px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="category_detail">
    <h1 class="category_detail_title">カテゴリ詳細</h1>
    <div>
      <p class="category_name" data-id="{{ $category['id'] }}">{{ $category['name'] }}</p>
      <div class="is_edit">
        <form action="{{ route("categories.update" ,$category['id']) }}" method="POST">
          {{-- putはhtmlではサポートされてないから下記のように@methodで書く必要がある --}}
          @method('PUT')
          @csrf
          <input type="text" class="edit_input" name="name" value="{{ $category['name'] }}" disabled>
          <textarea class="edit_textarea" name="description" placeholder="説明をかいてください" disabled>{{ $category['description'] }}</textarea>
          <button class="update_btn" type="submit">更新</button>
        </form>
      </div>
      <a class="edit_btn">編集</a>
      <a class="return_btn" href="{{ route('categories.index') }}">戻る</a>
      <a class="quiz_btn" href="{{ route('quizzes.create').'?category_id='.$category['id'] }}">クイズ新規登録</a>
      {{-- route()はURLを生成するだけ。→http://localhost/quizzes/create、文字列を生成している。パラメーターをつけたいときは、?キー＝バリュー --}}
      {{-- <div>{{ route('quizzes.create') }}</div>マスタッシュ構文です。{{  }}の中にPHPの＄なんとかって書く。 --}}
    </div>
  </div>
  </div>
</body>
</html>
