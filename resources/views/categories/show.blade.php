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

    }
    .return_btn:hover{
      color: black;
      background-color: #fff;
      border: 1px solid black;
    }
    .is_edit{
      display: none;
    }
    .category_name {
      cursor: pointer; /* カテゴリー名がクリック可能になる */
    }
    .edit_input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 10px;
    }
    .edit_textarea {
      width: 100%;
      height: 150px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <h1>カテゴリ詳細ページ</h1>
  <div>
    <p class="category_name" data-id="{{ $category['id'] }}">{{ $category['name'] }}</p><div class="is_edit"></div>
      <form action="{{ route("categories.update" ,$category['id']) }}" method="POST">@csrf
        <input type="hidden" name="_method" value="PUT"><input type="text" class="edit_input" name="category_name" value="{{ $category['name'] }}">
        <textarea class="edit_textarea" name="description">{{ $category['description'] }}</textarea><button type="submit">更新</button>
      </form>
    <a class="return_btn" href="{{ route('categories.index') }}">戻る</a>

  </div>
</body>
</html>
