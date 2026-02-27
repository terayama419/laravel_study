<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>食品編集</title>
</head>
<body>
    <h1>食品編集 (ID: {{ $food->id }})</h1>

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

    <form method="POST" action="{{ route('foods.update', $food) }}">
        @method('PUT')
        @include('foods._form')
        <div>
            <button type="submit">更新</button>
            <a href="{{ route('foods.index') }}">一覧に戻る</a>
        </div>
    </form>

    <h2>在庫追加</h2>
    <p>現在在庫: {{ $food->stock }}</p>
    <form method="POST" action="{{ route('foods.addStock', $food) }}">
        @csrf
        <label>追加数:
            <input type="number" name="quantity" min="1" value="1" style="width:60px;">
        </label>
        @error('quantity') <div style="color:red">{{ $message }}</div> @enderror
        <button type="submit">在庫追加</button>
    </form>
</body>
</html>

