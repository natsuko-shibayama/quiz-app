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
  <div>
    <h1 class="category_detail_title">クイズ一覧</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>カテゴリー名</th>
          <th>クイズ問題</th>
          <th>クイズ答え</th>
          <th>作成日時</th>
          <th>更新日時</th>
        </tr>
      </thead>
      <tbody>
        @if($quizzes !== null){
          @foreach ($quizzes as $quiz)
              <tr>
                <td>{{ $quiz['id'] }}</td>
                <td>{{ $quiz['category_id'] }}</td>
                <td>{{ $quiz['question'] }}</td>
                <td>{{ $quiz['answer'] }}</td>
                <td>{{ $quiz['created_at'] }}</td>
                <td>{{ $quiz['updated_at'] }}</td>
              </tr>
          @endforeach
        }else{
          
        }
        @endif
      </tbody>
    </table>
    <div>
      <a class="return_btn" type="submit" href="{{ route('') }}">戻る</a>
    </div>

  </div>
  </div>
</body>
</html>
