<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\View\View;

class TextController extends Controller
{
    public function show(Text $text): View
    {
        abort_if($text->is_blocked, 404);

        $text->load(['category', 'user']);

        return view('texts.show', compact('text'));
    }
}
