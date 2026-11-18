@php
    $roleNames = [
        'admin' => 'Администратор',
        'journalist' => 'Журналист',
        'user' => 'Пользователь',
    ];
@endphp

<header class="site-header">
    <div class="container header-inner">
        <a class="logo" href="{{ route('home') }}">{{ config('app.name') }}</a>

        <nav class="nav">
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('categories.index') }}">Категории</a>

            @auth
                @if (in_array(auth()->user()->role->name, ['journalist', 'admin']))
                    <a href="{{ route('journalist.index') }}">Журналист</a>
                @endif

                @if (auth()->user()->role->name === 'admin')
                    <a href="{{ route('admin.index') }}">Админ</a>
                @endif

                <span class="user">{{ auth()->user()->login }} · {{ $roleNames[auth()->user()->role->name] }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="link-button">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}">Вход</a>
                <a href="{{ route('register') }}">Регистрация</a>
            @endauth
        </nav>
    </div>
</header>
