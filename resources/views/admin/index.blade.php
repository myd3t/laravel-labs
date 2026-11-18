@php
    $roleNames = [
        'admin' => 'Администратор',
        'journalist' => 'Журналист',
        'user' => 'Пользователь',
    ];
@endphp

<x-layout>
    <h1>Админ-панель</h1>

    <section class="section">
        <h2>Статьи</h2>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Категория</th>
                        <th>Автор</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($texts as $text)
                        <tr>
                            <td>{{ $text->heading }}</td>
                            <td>{{ $text->category->name }}</td>
                            <td>{{ $text->user->login }}</td>
                            <td>{{ $text->is_blocked ? 'Заблокирована' : 'Опубликована' }}</td>
                            <td class="actions">
                                <a class="button small" href="{{ route('admin.texts.edit', $text) }}">Редактировать</a>

                                <form action="{{ route('admin.texts.block', $text) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="small">
                                        {{ $text->is_blocked ? 'Разблокировать' : 'Заблокировать' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.texts.destroy', $text) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="small danger">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <h2>Пользователи</h2>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Логин</th>
                        <th>Роль</th>
                        <th>Изменить роль</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->login }}</td>
                            <td>{{ $roleNames[$user->role->name] }}</td>
                            <td>
                                <form action="{{ route('admin.users.role', $user) }}" method="POST" class="inline-form">
                                    @csrf
                                    @method('PATCH')

                                    <select name="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @selected($user->role_id === $role->id)>
                                                {{ $roleNames[$role->name] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="small">Сохранить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout>
