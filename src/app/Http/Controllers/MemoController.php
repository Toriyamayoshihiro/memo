<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Category;


class MemoController extends Controller
{
    public function index(Request $request)
{
    $query = Memo::with('category');
    if ($request->filled('keyword')) {
        $keywords = explode(',', $request->keyword);
        foreach ($keywords as $keyword) {
            $query->where(
                'keywords',
                'like',
                '%' . trim($keyword) . '%');
                }
    }
    if ($request->filled('category')) {
        $query->where(
            'category_id',
            $request->category
        );
    }
    $memos = $query
        ->orderBy('worked_at', 'desc')
        ->get();
    $categories = Category::all();
    return view(
        'index',
        compact(
            'memos',
            'categories'
        ));
    }
}
