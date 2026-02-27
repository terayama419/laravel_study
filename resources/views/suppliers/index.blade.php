<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>仕入先一覧</title>
</head>
<body>
    <h1>仕入先一覧</h1>

    @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('suppliers.create') }}">新規登録</a>

    <h2>検索</h2>
    <form method="GET" action="{{ route('suppliers.index') }}">
        <div>
            <label>名称:
                <input type="text" name="name" value="{{ request('name') }}">
            </label>
        </div>
        <div>
            <button type="submit">検索</button>
            <a href="{{ route('suppliers.index') }}">クリア</a>
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
        @forelse ($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->id }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->businessHours }}</td>
                <td>{{ $supplier->phoneNumber }}</td>
                <td>{{ $supplier->representativeName }}</td>
                <td>
                    <a href="{{ route('suppliers.edit', $supplier) }}">編集</a>

                    @php
                        $foodNames = $supplier->foods->pluck('name')->implode('、');
                    @endphp

                    <form method="POST"
                          action="{{ route('suppliers.destroy', $supplier) }}"
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
        {{ $suppliers->links() }}
    </div>
</body>
</html>

