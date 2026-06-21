@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="memo-detail">

    <div class="memo-detail__heading">
        <h2>メモ詳細</h2>
    </div>

    <table class="memo-detail__table">
        <tr>
            <th>作業日</th>
            <td>{{ $memo->worked_at->format('Y年m月d日') }}</td>
        </tr>
        <tr>
            <th>工種</th>
            <td>{{ $memo->work_type }}</td>
        </tr>
        <tr>
            <th>カテゴリー</th>
            <td>{{ $memo->category->name }}</td>
        </tr>
        <tr>
            <th>検索キーワード</th>
            <td>{{ $memo->keywords }}</td>
        </tr>
        <tr>
            <th>内容</th>
            <td class="memo-content">
                {!! nl2br(e($memo->content)) !!}
            </td>
        </tr>
        @if($memo->image_path)
        <tr>
            <th>写真</th>
            <td>
                <img
                    src="{{ Storage::url($memo->image_path) }}"
                    alt="現場写真"
                    class="memo-image">
            </td>
        </tr>
        @endif
        <tr>
            <th>登録日時</th>
            <td>{{ $memo->created_at->format('Y/m/d H:i') }}</td>
        </tr>
        <tr>
            <th>更新日時</th>
            <td>{{ $memo->updated_at->format('Y/m/d H:i') }}</td>
        </tr>
    </table>

    <div class="memo-detail__buttons">

        <a
            href="/memo/{{ $memo->id }}/edit"
            class="edit-button"
        >
            編集する
        </a>

        <form
            action="/memo/delete/{{ $memo->id }}"
            method="post"
            onsubmit="return confirm('削除しますか？')"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="delete-button"
            >
                削除する
            </button>

        </form>

    </div>

</div>

@endsection