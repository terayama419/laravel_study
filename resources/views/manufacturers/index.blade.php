<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メーカー一覧</title>
</head>
<body>
    <h1>メーカー一覧</h1>

    @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('manufacturers.create') }}">新規登録</a>

    <h2>検索</h2>
    <form method="GET" action="{{ route('manufacturers.index') }}">
        <div>
            <label>名称:
                <input type="text" name="name" value="{{ request('name') }}">
            </label>
        </div>
        <div>
            <button type="submit">検索</button>
            <a href="{{ route('manufacturers.index') }}">クリア</a>
        </div>
    </form>

    <h2>一覧</h2>
    <table border="1" cellpadding="4" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>住所</th>
            <th>営業時間</th>
            <th>連絡先電話番号</th>
            <th>代表者名</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($manufacturers as $manufacturer)
            <tr>
                <td>{{ $manufacturer->id }}</td>
                <td>{{ $manufacturer->name }}</td>
                <td>{{ $manufacturer->address }}</td>
                <td>{{ $manufacturer->businessHours }}</td>
                <td>{{ $manufacturer->phoneNumber }}</td>
                <td>{{ $manufacturer->representativeName }}</td>
                <td>
                    <a href="{{ route('manufacturers.edit', $manufacturer) }}">編集</a>

                    @php
                        $foodNames = $manufacturer->foods->pluck('name')->implode('、');
                    @endphp

                    <form method="POST"
                          action="{{ route('manufacturers.destroy', $manufacturer) }}"
                          style="display:inline-block"
                          onsubmit="return confirm('すでに紐づいている食品があります。\n食品は以下です。\n{{ $foodNames }}\n削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">データがありません。</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div>
        {{ $manufacturers->links() }}
    </div>
</body>
</html>

