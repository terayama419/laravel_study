<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メーカー新規登録</title>
</head>
<body>
    <h1>メーカー新規登録</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('manufacturers.store') }}">
        @include('manufacturers._form')
        <div>
            <button type="submit">登録</button>
            <a href="{{ route('manufacturers.index') }}">一覧に戻る</a>
        </div>
    </form>
</body>
</html>

