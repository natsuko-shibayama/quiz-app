<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>カテゴリ登録</title>
  <style>
    .btn_wrapper{
      padding-top: 10px;
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
      border-color: white;

    }
    .return_btn:hover{
      color: black;
      background-color: #fff;
      border: 1px solid black;
    }
    .detail_btn{
      display: block;
      width: 150px;
      padding: 10px;
      background-color:coral;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 4px;
      border-color: coral;
    }
    .detail_btn:hover{
      color: black;
      background-color: #fff;
      border: 1px solid black;
    }
  </style>
</head>
<body>
  <h1>クイズ新規登録</h1>
  {{-- formの中が遷移先、ボタンには書かない --}}
  <form action="{{ route('quizzes.store') }}" method="POST">
    {{ csrf_field() }}
    <div>
      {{-- エラー --}}
      @if(count($errors) > 0)
          <div class="error_message">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <table>
        <tbody>
            <tr>
                <th scope="row">クイズ問題</th>
                <td><textarea type="textarea" id="question" name="question"></textarea></td>
            </tr>
            <tr>
                <th scope="row">クイズ答え</th>
                <td><input type="text" id="answer" name="answer"></td>
            </tr>
      </table>
    </div>
    <div class="btn_wrapper">
      <button class="detail_btn" type="submit" >クイズ登録</button>
    </div>
    <div class="btn_wrapper">
      <a class="return_btn" href="{{ route('categories.show', $category['id']) }}">戻る</a>
    </div>
    <input type="hidden" name="category_id" value="{{ $category['id'] }}">
    {{-- inputでキーとバリューを送る時のやり方↑nameとvalueをつかう --}}
  </form>
</body>
</html>
