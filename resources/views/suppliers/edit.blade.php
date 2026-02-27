<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>仕入先編集</title>
</head>
<body>
    <h1>仕入先編集 (ID: {{ $supplier->id }})</h1>

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

    <form method="POST" action="{{ route('suppliers.update', $supplier) }}">
        @method('PUT')
        @include('suppliers._form')
        <div>
            <button type="submit">更新</button>
            <a href="{{ route('suppliers.index') }}">一覧に戻る</a>
        </div>
    </form>
</body>
</html>

