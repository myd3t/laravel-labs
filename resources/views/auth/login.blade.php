<x-layout>
    <div class="form-card">
        <h1>Вход</h1>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label>
                Логин
                <input type="text" name="login" value="{{ old('login') }}" required autofocus>
            </label>

            <label>
                Пароль
                <input type="password" name="password" required>
            </label>

            <button type="submit">Войти</button>
        </form>

        <p class="meta">Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
    </div>
</x-layout>
