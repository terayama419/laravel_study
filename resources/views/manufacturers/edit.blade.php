<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メーカー編集</title>
</head>
<body>
    <h1>メーカー編集 (ID: {{ $manufacturer->id }})</h1>

    @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('manufacturers.update', $manufacturer) }}">
        @method('PUT')
        @include('manufacturers._form')
        <div>
            <button type="submit">更新</button>
            <a href="{{ route('manufacturers.index') }}">一覧に戻る</a>
        </div>
    </form>
</body>
</html>

