@csrf

<div>
    <label>名称:
        <input type="text" name="name" value="{{ old('name', $manufacturer->name ?? '') }}">
    </label>
    @error('name') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>住所:
        <input type="text" name="address" value="{{ old('address', $manufacturer->address ?? '') }}">
    </label>
    @error('address') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>営業時間:
        <input type="text" name="businessHours" value="{{ old('businessHours', $manufacturer->businessHours ?? '') }}">
    </label>
    @error('businessHours') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>連絡先電話番号:
        <input type="text" name="phoneNumber" value="{{ old('phoneNumber', $manufacturer->phoneNumber ?? '') }}">
    </label>
    @error('phoneNumber') <div style="color:red">{{ $message }}</div> @enderror
</div>

<div>
    <label>代表者名:
        <input type="text" name="representativeName" value="{{ old('representativeName', $manufacturer->representativeName ?? '') }}">
    </label>
    @error('representativeName') <div style="color:red">{{ $message }}</div> @enderror
</div>

