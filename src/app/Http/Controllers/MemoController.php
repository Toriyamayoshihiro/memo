<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
    return view('index',compact('memos','categories'));
    }
    public function getMemorize(){
        $categories = Category::all();

        return view('memorize',compact('categories'));
    }
    public function postMemorize(Request $request){
        $image_path = null;

        if ($request->hasFile('image')){
            $imag_path = $request->file('image')->store('memos','public');
        }
        
        
        $memo_data = $request->only('worked_at','work_type','category_id','keywords','content',);
        $memo_data['image_path'] = $image_path;
        $memo_data['user_id'] = Auth::user()->id;

        $memo = Memo::create($memo_data);

        return redirect()->route('memo.detail', ['memo_id' => $memo->id]);
    }
    public function detail($memo_id){
        $memo = Memo::with('category')->findOrFail($memo_id);

        return view('detail',compact('memo'));
    }
    public function getEdit($memo_id){
        $memo = Memo::with('category')->findOrFail($memo_id);

        $categories = Category::all();

        return view('detail_edit',compact('memo','categories'));
    }
    public function postEdit(Request $request, $memo_id){
        $memo = Memo::findOrFail($memo_id);

        if ($request->hasFile('image')){
            $newMemo = $request->file('image')->store('memos','public');
        }
        $newMemo = $request->only('worked_at','work_type','category_id','keywords','content',);

        $memo->update($newMemo);

        return redirect()->route('memo.detail',[$memo_id => $memo->id]);
    }
    public function delete($memo_id){
        $memo = Memo::where('user_id', Auth::id())->findOrFail($memo_id);

        if ($memo->image_path) {
            Storage::disk('public')->delete($memo->image_path);
        }
        
        $memo->delete();

        return redirect('/');
    }
}
