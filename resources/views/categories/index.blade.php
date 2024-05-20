<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>カテゴリ一覧</title>
  <style>
    .return_btn{
      display: block;
      width: 100px;
      padding: 10px;
      background-color: cadetblue;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 4px;
      margin-top: 10px;
    }
    .return_btn:hover{
      color: black;
      background-color: #fff;
      border: 1px solid black;
    }

    td{
      padding-right: 10px;
    }
    .name_link{
      /* text-decoration: none; */
      color: black;
      font-weight: bold;
    }
    .name_link:hover{
      color: darkorange;
    }
    .attention{
      font-size: 20px;
      font-weight: bold;
    }
    </style>
</head>
<body>
  <div id="top">
    <main class="py-4">
      <h1>カテゴリ一覧</h1>
      <p class="attention">※ カテゴリの名前をクリックして詳細画面へ！</p>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>カテゴリ名</th>
            <th>作成日付</th>
            <th>更新日付</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{ $category['id'] }}</td>
            <td><a class="name_link" href="{{ route('categories.show' , $category['id']) }}">{{ $category['name'] }}</a></td>
            <td>{{ $category['created_at'] }}</td>
            <td>{{ $category['updated_at'] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div>
        <a class="return_btn" type="submit" href="{{ route('dashboard') }}">戻る</a>
      </div>
    </main>
  </div>
</body>
</html>