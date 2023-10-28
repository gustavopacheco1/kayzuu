<?php

namespace App\Http\Controllers;

use App\Enums\AccountTypeEnum;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(): View
    {
        $newses = News::get(['id', 'title', 'content', 'created_at']);
        $isAdmin = !auth()->guest() && auth()->user()->type == AccountTypeEnum::GOD->value;

        return view('news.index', compact('newses', 'isAdmin'));
    }

    public function create(): View
    {
        return view('news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        News::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('news.index');
    }

    public function edit(News $news): View
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('news.index');
    }
}
