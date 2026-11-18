<x-layout>
    <div class="page-head">
        <h1>Мои статьи</h1>
        <a class="button" href="{{ route('journalist.create') }}">Новая статья</a>
    </div>

    @forelse ($texts as $text)
        <article class="card">
            <h2>{{ $text->heading }}</h2>
            <p class="meta">
                {{ $text->category->name }} · {{ $text->created_at->format('d.m.Y H:i') }} ·
                {{ $text->is_blocked ? 'Заблокирована' : 'Опубликована' }}
            </p>
            <a class="button small" href="{{ route('journalist.edit', $text) }}">Редактировать</a>
        </article>
    @empty
        <div class="empty">Вы пока не написали ни одной статьи.</div>
    @endforelse
</x-layout>
