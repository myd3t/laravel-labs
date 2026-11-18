<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $texts = Text::with(['category', 'user'])
            ->where('is_blocked', false)
            ->latest()
            ->paginate(5);

        return view('home', compact('texts'));
    }
}
