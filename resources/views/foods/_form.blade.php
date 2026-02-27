@csrf

<div>
    <label>商品コード:
        <input type="text" name="productCode" value="{{ old('productCode', $food->productCode ?? '') }}">
    </label>
    @error('productCode') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>名称:
        <input type="text" name="name" value="{{ old('name', $food->name ?? '') }}">
    </label>
    @error('name') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>メーカー:
        <select name="manufacturerId">
            <option value="">-- 未選択 --</option>
            @foreach ($manufacturers as $manufacturer)
                <option value="{{ $manufacturer->id }}" @selected(old('manufacturerId', $food->manufacturerId ?? '') == $manufacturer->id)>
                    {{ $manufacturer->name }}
                </option>
            @endforeach
        </select>
    </label>
    @error('manufacturerId') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>仕入先:
        <select name="supplierId">
            <option value="">-- 未選択 --</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" @selected(old('supplierId', $food->supplierId ?? '') == $supplier->id)>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
    </label>
    @error('supplierId') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>仕入値:
        <input type="number" step="0.01" name="purchasePrice" value="{{ old('purchasePrice', $food->purchasePrice ?? '') }}">
    </label>
    @error('purchasePrice') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>売価:
        <input type="number" step="0.01" name="sellingPrice" value="{{ old('sellingPrice', $food->sellingPrice ?? '') }}">
    </label>
    @error('sellingPrice') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>在庫:
        <input type="number" name="stock" min="0" value="{{ old('stock', $food->stock ?? 0) }}">
    </label>
    @error('stock') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>賞味期限:
        <input type="date" name="expirationDate" value="{{ old('expirationDate', isset($food->expirationDate) ? $food->expirationDate : '') }}">
    </label>
    @error('expirationDate') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>入荷日:
        <input type="date" name="arrivalDate" value="{{ old('arrivalDate', isset($food->arrivalDate) ? $food->arrivalDate : '') }}">
    </label>
    @error('arrivalDate') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>ロット番号:
        <input type="text" name="lotNumber" value="{{ old('lotNumber', $food->lotNumber ?? '') }}">
    </label>
    @error('lotNumber') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>JANコード:
        <input type="text" name="janCode" value="{{ old('janCode', $food->janCode ?? '') }}">
    </label>
    @error('janCode') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>保存方法:
        <input type="text" name="storageMethod" value="{{ old('storageMethod', $food->storageMethod ?? '') }}">
    </label>
    @error('storageMethod') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>カテゴリ:
        <input type="text" name="category" value="{{ old('category', $food->category ?? '') }}">
    </label>
    @error('category') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>最低在庫数:
        <input type="number" name="minimumStock" min="0" value="{{ old('minimumStock', $food->minimumStock ?? 0) }}">
    </label>
    @error('minimumStock') <div style="color:red">{{ $message }}</div> @enderror
</div>

