<x-layout>
    <div class="page-head">
        <h1>Категории</h1>
        <span class="meta">Выберите интересующий раздел</span>
    </div>

    <div class="grid">
        @foreach ($categories as $category)
            <a class="card category-card" href="{{ route('categories.show', $category) }}">
                <h2>{{ $category->name }}</h2>
                <p class="meta">Статей: {{ $category->texts_count }}</p>
            </a>
        @endforeach
    </div>
</x-layout>
