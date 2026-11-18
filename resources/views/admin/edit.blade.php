<x-layout>
    <div class="form-card wide">
        <h1>Редактирование статьи</h1>

        <form action="{{ route('admin.texts.update', $text) }}" method="POST">
            @csrf
            @method('PUT')

            <label>
                Заголовок
                <input type="text" name="heading" value="{{ old('heading', $text->heading) }}" required>
            </label>

            <label>
                Категория
                <select name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $text->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Текст статьи
                <textarea name="text" rows="14" required>{{ old('text', $text->text) }}</textarea>
            </label>

            <label class="checkbox">
                <input type="checkbox" name="is_blocked" value="1" @checked(old('is_blocked', $text->is_blocked))>
                Заблокировать статью
            </label>

            <button type="submit">Сохранить</button>
        </form>
    </div>
</x-layout>
