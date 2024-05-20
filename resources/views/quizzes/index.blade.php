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
    .quiz_btn{
      display: block;
      width: 180px;
      padding: 10px;
      background-color:gold;
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
  <div>クイズ一覧が表示されるよ！</div>
  </div>
</body>
</html>
