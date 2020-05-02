<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * 文章列表
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ajax方式实现分页
        if ($request->header('X-Requested-With') == 'XMLHttpRequest') {
            $start = $request->get('start', 0);
            $datemin = $request->get('datemin');
            $datemax = $request->get('datemax');
            $title = $request->get('title');
            $query = Article::where('id', '>', 0);
            // 根据日期过滤
            if (!empty($datemin) && !empty($datemax)) {
                $datemin = date('Y-m-d H:i:s', strtotime($datemin. ' 00:00:00'));
                $datemax = date('Y-m-d H:i:s', strtotime($datemax. ' 23:59:59'));
                $query->whereBetween('created_at', [$datemin, $datemax]);
            }
            // 根据关键字过滤
            if (!empty($title)) {
                $query->where('title', 'like', "%{$title}%");
            }
            // 使用min函数，防止用户暴力搜索，最多支持100条
            $length = min(100, $request->get('length', 10));
            $total = $query->count();
            $data = $query->offset($start)->limit($length)->get();
            $result = [
                'draw' => $request->get('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data
            ];
            return $result;
        }
        $data = Article::all();
        return view('admin.article.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
