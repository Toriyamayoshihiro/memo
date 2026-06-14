@extends('layout.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')

<div class="memo-edit">

```
<div class="memo-edit__heading">
    <h2>メモ編集</h2>
</div>

<form
    action="/detail/{{ $memo->id }}/edit"
    method="post"
    enctype="multipart/form-data"
    class="memo-form"
>
    @csrf
    @method('PATCH')

    <div class="form__group">
        <label>作業日</label>

        <input
            type="date"
            name="worked_at"
            value="{{ old('worked_at', $memo->worked_at->format('Y-m-d')) }}"
        >

        @error('worked_at')
            <div class="form__error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form__group">
        <label>工種</label>

        <input
            type="text"
            name="work_type"
            value="{{ old('work_type', $memo->work_type) }}"
        >

        @error('work_type')
            <div class="form__error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form__group">
        <label>カテゴリー</label>

        <select name="category_id">

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    @selected(
                        old('category_id', $memo->category_id)
                        == $category->id
                    )
                >
                    {{ $category->name }}
                </option>

            @endforeach

        </select>

        @error('category_id')
            <div class="form__error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form__group">
        <label>検索キーワード</label>

        <input
            type="text"
            name="keywords"
            value="{{ old('keywords', $memo->keywords) }}"
        >

        @error('keywords')
            <div class="form__error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form__group">
        <label>内容</label>

        <textarea
            name="content"
            rows="10"
        >{{ old('content', $memo->content) }}</textarea>

        @error('content')
            <div class="form__error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form__group">
        <label>現在の写真</label>

        @if($memo->image_path)
            <img
                src="{{ Storage::url($memo->image_path) }}"
                alt="memo image"
                width="300"
            >
        @else
            <p>画像なし</p>
        @endif
    </div>

    <div class="form__group">
        <label>写真変更</label>

        <input
            type="file"
            name="image"
        >

        @error('image')
            <div class="form__error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form__button">
        <button type="submit">
            更新する
        </button>
    </div>

</form>
```

</div>

@endsection
