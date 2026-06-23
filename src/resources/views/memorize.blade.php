@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/memorize.css') }}">
@endsection

@section('content')

<div class="memo-create">
    <div class="memo-create__heading">
        <h2>新規メモ作成</h2>
    </div>

    <form action="/memo/create" method="post" enctype="multipart/form-data" class="memo-form">
        @csrf

        <div class="form__group">
            <label class="form__label">作業日</label>
            <input type="text" name="worked_at" value="{{ old('worked_at') }}">
            @error('worked_at')
                <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form__group">
            <label class="form__label">工種</label>
            <input type="text" name="work_type" value="{{ old('work_type') }}" placeholder="例：支承据付、型枠組立">
            @error('work_type')
                <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form__group">
            <label class="form__label">カテゴリー</label>
            <select name="category_id">
                <option value="">カテゴリーを選択してください</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                    {{old('category_id') == $category->id ? 'selected' :''}} 
                    >
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form__group">
            <label class="form__label">検索用キーワード</label>
            <input type="text" name="keywords" value="{{ old('keywords') }}" placeholder="例：桁高さ管理,温度変化,打設後">
            @error('keywords')
                <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form__group">
            <label class="form__label">内容</label>
            <textarea name="content" rows="10" placeholder="現場で気付いたこと、注意点、計算式、使った部材などを記録してください">{{ old('content') }}</textarea>
            @error('content')
                <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form__group">
            <label class="form__label">写真</label>
            <input type="file" name="image">
            @error('image')
                <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form__button">
            <button type="submit">登録する</button>
        </div>
    </form>
</div>

@endsection
