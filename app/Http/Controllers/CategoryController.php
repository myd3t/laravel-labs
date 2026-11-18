<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('texts')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        $texts = $category->texts()
            ->with('user')
            ->where('is_blocked', false)
            ->latest()
            ->paginate(5);

        return view('categories.show', compact('category', 'texts'));
    }
}
