<x-layout>
    <div class="form-card">
        <h1>Регистрация</h1>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <label>
                Логин
                <input type="text" name="login" value="{{ old('login') }}" required autofocus>
            </label>

            <label>
                Пароль
                <input type="password" name="password" required>
            </label>

            <label>
                Подтверждение пароля
                <input type="password" name="password_confirmation" required>
            </label>

            <button type="submit">Зарегистрироваться</button>
        </form>

        <p class="meta">Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
    </div>
</x-layout>
