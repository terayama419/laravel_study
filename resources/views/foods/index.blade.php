<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>食品一覧</title>
</head>
<body>
    <h1>食品一覧</h1>

    @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('foods.create') }}">新規登録</a>

    <h2>検索</h2>
    <form method="GET" action="{{ route('foods.index') }}">
        <div>
            <label>商品コード:
                <input type="text" name="productCode" value="{{ request('productCode') }}">
            </label>
        </div>
        <div>
            <label>名称:
                <input type="text" name="name" value="{{ request('name') }}">
            </label>
        </div>
        <div>
            <label>メーカー名:
                <input type="text" name="manufacturerName" value="{{ request('manufacturerName') }}">
            </label>
        </div>
        <div>
            <label>仕入先名:
                <input type="text" name="supplierName" value="{{ request('supplierName') }}">
            </label>
        </div>
        <div>
            <label>賞味期限:
                <input type="date" name="expirationDate" value="{{ request('expirationDate') }}">
            </label>
        </div>
        <div>
            <label>入荷日:
                <input type="date" name="arrivalDate" value="{{ request('arrivalDate') }}">
            </label>
        </div>
        <div>
            <label>ロット番号:
                <input type="text" name="lotNumber" value="{{ request('lotNumber') }}">
            </label>
        </div>
        <div>
            <label>JANコード:
                <input type="text" name="janCode" value="{{ request('janCode') }}">
            </label>
        </div>
        <div>
            <label>保存方法:
                <input type="text" name="storageMethod" value="{{ request('storageMethod') }}">
            </label>
        </div>
        <div>
            <label>カテゴリ:
                <input type="text" name="category" value="{{ request('category') }}">
            </label>
        </div>
        <div>
            <button type="submit">検索</button>
            <a href="{{ route('foods.index') }}">クリア</a>
        </div>
    </form>

    <h2>一覧</h2>
    <table border="1" cellpadding="4" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>商品コード</th>
            <th>名称</th>
            <th>メーカー</th>
            <th>仕入先</th>
            <th>仕入値</th>
            <th>売価</th>
            <th>在庫</th>
            <th>賞味期限</th>
            <th>入荷日</th>
            <th>ロット番号</th>
            <th>JANコード</th>
            <th>保存方法</th>
            <th>カテゴリ</th>
            <th>最低在庫数</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($foods as $food)
            <tr @if($food->stock < $food->minimumStock) style="background-color: #ffe5e5;" @endif>
                <td>{{ $food->id }}</td>
                <td>{{ $food->productCode }}</td>
                <td>{{ $food->name }}</td>
                <td>{{ optional($food->manufacturer)->name }}</td>
                <td>{{ optional($food->supplier)->name }}</td>
                <td>{{ $food->purchasePrice }}</td>
                <td>{{ $food->sellingPrice }}</td>
                <td>{{ $food->stock }}</td>
                <td>{{ $food->expirationDate }}</td>
                <td>{{ $food->arrivalDate }}</td>
                <td>{{ $food->lotNumber }}</td>
                <td>{{ $food->janCode }}</td>
                <td>{{ $food->storageMethod }}</td>
                <td>{{ $food->category }}</td>
                <td>{{ $food->minimumStock }}</td>
                <td>
                    <a href="{{ route('foods.edit', $food) }}">編集</a>

                    <form method="POST" action="{{ route('foods.destroy', $food) }}" style="display:inline-block" onsubmit="return confirm('削除してよろしいですか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>

                    <form method="POST" action="{{ route('foods.addStock', $food) }}" style="display:inline-block; margin-left: 8px;">
                        @csrf
                        <input type="number" name="quantity" min="1" value="1" style="width:60px;">
                        <button type="submit">在庫追加</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="16">データがありません。</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div>
        {{ $foods->links() }}
    </div>
</body>
</html>

