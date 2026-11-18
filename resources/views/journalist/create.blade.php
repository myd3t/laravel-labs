<x-layout>
    <div class="form-card wide">
        <h1>Новая статья</h1>

        <form action="{{ route('journalist.store') }}" method="POST">
            @csrf

            <label>
                Заголовок
                <input type="text" name="heading" value="{{ old('heading') }}" required>
            </label>

            <label>
                Категория
                <select name="category_id" required>
                    <option value="">Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Текст статьи
                <textarea name="text" rows="14" required>{{ old('text') }}</textarea>
            </label>

            <button type="submit">Опубликовать</button>
        </form>
    </div>
</x-layout>
