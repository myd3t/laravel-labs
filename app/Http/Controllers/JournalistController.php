<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Text;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JournalistController extends Controller
{
    public function index(): View
    {
        $texts = Text::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('journalist.index', compact('texts'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('journalist.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'heading' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'text' => ['required', 'string'],
        ]);

        $data['user_id'] = auth()->id();

        Text::create($data);

        return redirect()->route('journalist.index')->with('success', 'Статья опубликована.');
    }

    public function edit(Text $text): View
    {
        abort_if($text->user_id !== auth()->id(), 403);

        $categories = Category::orderBy('name')->get();

        return view('journalist.edit', compact('text', 'categories'));
    }

    public function update(Request $request, Text $text): RedirectResponse
    {
        abort_if($text->user_id !== auth()->id(), 403);

        $data = $request->validate([
            'heading' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'text' => ['required', 'string'],
        ]);

        $text->update($data);

        return redirect()->route('journalist.index')->with('success', 'Статья обновлена.');
    }
}
