<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use App\Models\Text;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $texts = Text::with(['category', 'user'])->latest()->get();
        $users = User::with('role')->orderBy('login')->get();
        $roles = Role::orderBy('name')->get();

        return view('admin.index', compact('texts', 'users', 'roles'));
    }

    public function edit(Text $text): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.edit', compact('text', 'categories'));
    }

    public function update(Request $request, Text $text): RedirectResponse
    {
        $data = $request->validate([
            'heading' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'text' => ['required', 'string'],
            'is_blocked' => ['nullable', 'boolean'],
        ]);

        $data['is_blocked'] = $request->boolean('is_blocked');

        $text->update($data);

        return redirect()->route('admin.index')->with('success', 'Статья изменена.');
    }

    public function block(Text $text): RedirectResponse
    {
        $text->update(['is_blocked' => ! $text->is_blocked]);

        return redirect()->route('admin.index')->with('success', 'Статус статьи изменён.');
    }

    public function destroy(Text $text): RedirectResponse
    {
        $text->delete();

        return redirect()->route('admin.index')->with('success', 'Статья удалена.');
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $user->update($data);

        return redirect()->route('admin.index')->with('success', 'Роль пользователя изменена.');
    }
}
