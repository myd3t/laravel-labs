<x-layout>
    <div class="page-head">
        <h1>Все новости</h1>
        <span class="meta">Свежие публикации</span>
    </div>

    @forelse ($texts as $text)
        <article class="card">
            <h2>
                <a href="{{ route('texts.show', $text) }}">{{ $text->heading }}</a>
            </h2>
            <p class="meta">
                {{ $text->category->name }} · {{ $text->user->login }} · {{ $text->created_at->format('d.m.Y H:i') }}
            </p>
            <p>{{ \Illuminate\Support\Str::limit($text->text, 220) }}</p>
        </article>
    @empty
        <div class="empty">Статей пока нет.</div>
    @endforelse

    {{ $texts->links('pagination.simple') }}
</x-layout>
