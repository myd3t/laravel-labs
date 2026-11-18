<x-layout>
    <article class="article">
        <h1>{{ $text->heading }}</h1>
        <p class="meta">
            {{ $text->category->name }} · {{ $text->user->login }} · {{ $text->created_at->format('d.m.Y H:i') }}
        </p>
        <div class="article-text">{!! nl2br(e($text->text)) !!}</div>
    </article>
</x-layout>
