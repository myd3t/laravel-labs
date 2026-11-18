<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'login' => ['required', 'string', 'max:255', 'unique:users,login'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $role = Role::where('name', 'user')->firstOrFail();

        $user = User::create([
            'login' => $data['login'],
            'password' => $data['password'],
            'role_id' => $role->id,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Регистрация выполнена.');
    }
}
