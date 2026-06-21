@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="index_content">
    <div class="index_heading">
        <h2>メモ一覧</h2>
    </div>
    <form action="/" method="get">
        <select name="category">
                <option value="">カテゴリー選択</option>

                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(request('category') == $category)>
                        {{ $category->category }}
                    </option>
                @endforeach
        </select>
        <button type="submit">
            絞り込み
        </button>
    </form>
    
    <table class="memo_table">
        <tr class="memo_row">
            <th class="memo_label">作業日</th>
            <th class="memo_label">工種</th>
            <th class="memo_label">カテゴリー</th>
            <th class="memo_label">キーワード</th>
            <th class="memo_label">内容(30文字)</th>
            <th class="memo_label">詳細</th>
        </tr>
    
    @foreach($memos as $memo)

        <tr>
            <td>
                {{ $memo->worked_at->format('Y/m/d') }}
            </td>
            <td>
                {{ $memo->work_type }}
            </td>
            <td>
                {{ $memo->category->category }}
            </td>
            <td>
                {{ $memo->keywords }}
            </td>
            <td>
                 {{ \Illuminate\Support\Str::limit($memo->content, 30, '...') }}
            </td>
            <td>
                <a href="/memo/{{$memo->id}}">
                    詳細
                </a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection