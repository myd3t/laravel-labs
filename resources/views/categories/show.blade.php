<x-layout>
    <div class="page-head">
        <div>
            <p class="meta"><a href="{{ route('categories.index') }}">Все категории</a></p>
            <h1>{{ $category->name }}</h1>
        </div>
    </div>

    @forelse ($texts as $text)
        <article class="card">
            <h2>
                <a href="{{ route('texts.show', $text) }}">{{ $text->heading }}</a>
            </h2>
            <p class="meta">
                {{ $text->user->login }} · {{ $text->created_at->format('d.m.Y H:i') }}
            </p>
            <p>{{ \Illuminate\Support\Str::limit($text->text, 220) }}</p>
        </article>
    @empty
        <div class="empty">В этой категории пока нет статей.</div>
    @endforelse

    {{ $texts->links('pagination.simple') }}
</x-layout>
