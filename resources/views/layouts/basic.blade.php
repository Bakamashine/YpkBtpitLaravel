<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('meta_description', 'Платформа для заказа товаров и услуг')">
    <meta name="keywords" content="@yield('meta_keywords', 'товары, услуги, заказ, платформа')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="@yield('meta_og_title', 'Платформа для заказа товаров и услуг')">
    <meta property="og:description" content="@yield('meta_og_description', 'Платформа для заказа товаров и услуг')">
    <meta property="og:image" content="@yield('meta_og_image', asset('/img/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary">
    <link rel="icon" type="image/png" href="{{ asset('/img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">

    <title>@yield('title') :: {{ env('APP_NAME') }}</title>
</head>

<body>
<section class="myColorHeader">
    @auth
        <p class="mb-0 pt-2 text-center">Добро пожаловать, {{ auth()->user()->name }}</p>
    @endauth

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid flex-nowrap">
            <a class="navbar-brand" href="/">
                <img src="{{asset('img/logo.png')}}" alt="Логотип" class="myImg"/>
            </a>

            <div class="mySearh flex-grow-1 mx-3">
                <input class="form-control" type="search" placeholder="Поиск ... Пока не работает" aria-label="Поиск"/>
            </div>


            <div class="d-none d-lg-flex align-items-center">
                <div class="myIcons">
                    <div class="d-flex me-3 myStyleTextLogo header-icons align-items-center">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Вход</a>
                            <a href="{{ route('register') }}" class="btn btn-light btn-sm me-2">Регистрация</a>
                        @endguest
                        @auth
                            <div class="mx-1 text-center">
                                <a href="{{ route('home') }}" class="text-decoration-none">
                                    <img class="header__image__size" src="{{asset('img/user.png')}}"
                                         alt="Профиль"/>
                                    <p class="header__button__text">Профиль</p>
                                </a>
                            </div>
                            <div class="mx-1 text-center">
                                <a href="{{ route('logout') }}" class="text-decoration-none"
                                   onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                    <img class="header__image__size header__image-logout"
                                         src="{{asset('img/logout.png')}}"
                                         alt="Выход"/>
                                    <p class="header__button__text">Выйти</p>
                                </a>
                                <form id="logout-form-header" action="{{ route('logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </div>
                            <div class="mx-1 text-center">
                                <a href="{{ route('favourite.index') }}" class="text-decoration-none">
                                    <img class="header__image__size" src="{{asset('img/heart.png')}}"
                                         alt="Профиль"/>
                                    <p class="header__button__text">Избранное</p>
                                </a>
                            </div>
                        @endauth
                        <div class="mx-1 text-center">
                            <a href="{{route('about_us')}}" class="text-decoration-none">
                                <img class="header__image__size"
                                     src="{{asset('img/material-symbols_info-outline-rounded1.png')}}"
                                     alt="Информация"/>
                                <p class="header__button__text">О нас</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</section>


<div class="info hidden" id="info-for-users"></div>
<main>
    @if (Breadcrumbs::exists())
        <div class="container mt-3">
            {{ Breadcrumbs::render() }}
        </div>
    @endif

    @yield('content')

    <!-- ========= НИЖНЯЯ НАВИГАЦИЯ ДЛЯ МОБИЛЬНЫХ ========= -->
    <!-- Этот блок будет виден только на телефонах и находится внизу -->
    <div class="mobile-bottom-nav ">
        <div class="nav-icon text-center">
            <a href="{{ route('main') }}" class="text-decoration-none">
                <img src="{{asset('img/house.png')}}" alt="Главная">
                <div>
                    <span class="text-decoration-none text-white">Главная</span>
                </div>

            </a>
        </div>
        <div class="nav-icon text-center">
            <a href="{{route('feedback.index')}}" class="text-decoration-none">
                <img src="{{asset('img/comment.png')}}" alt="Отзывы">
                <div>
                    <span class="text-decoration-none text-white">Отзывы</span>
                </div>

            </a>
        </div>
        <div class="nav-icon text-center">
            <a href="{{ route('home') }}" class="text-decoration-none">
                <img src="{{asset('img/user.png')}}" alt="Профиль">
                <div>
                    <span class="text-decoration-none text-white">Профиль</span>
                </div>

            </a>
        </div>
        <div class="nav-icon text-center">
            <a href="{{route('favourite.index')}}" class="text-decoration-none">
                <img src="{{asset('img/heart.png')}}" alt="Избранное">
                <div>
                    <span class="text-decoration-none text-white">Избранное</span>
                </div>

            </a>
        </div>
        <div class="nav-icon text-center">
            <a href="" class="text-decoration-none">
                <img src="{{asset('img/material-symbols_info-outline-rounded1.png')}}" alt="О нас"/>
                <div>
                    <span class="text-decoration-none text-white">О нас</span>
                </div>

            </a>
        </div>
    </div>
    <!-- ================================================== -->
</main>

<footer class="py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <a href="/">
                    <img src="/img/logo.png" alt="Логотип" class="myImg" style="max-width: 150px;">
                </a>
            </div>
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <p class="text-white mb-0">&copy; {{ date('Y') }} Все права защищены</p>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <a href="/college.html" class="text-white text-decoration-none">О колледже</a>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

<script>
    let status = Boolean("{{env('APP_DEBUG')}}")
    const userStatusKey = "userStatus"
    let user_status = localStorage.getItem(userStatusKey)
    console.log("Site status: ", status)
    if (!user_status && status) {
        const info = document.getElementById('info-for-users')
        info.classList.remove('hidden')
        info.innerHTML += `
            <p>Сайт находится в разработке. При появлении каких-либо ошибок, просьба сделать скриншот и отправить по следущим адресам:</p>
            <a href="mailto:ivan.fa.002@gmail.com"></a>
            <p>Telegram: @Adski328</p>
            <p>Vk: https://vk.com/persik123321</p>
             <p>Для возврата сообщения, почистите локальное хранилище в вашем браузере</p>

            <p>Если вы ознакомились и хотите убрать данное сообщение, то нажмите сюда: </p>
        `

        const new_element = document.createElement("a")
        new_element.onclick = function () {
            localStorage.setItem(userStatusKey, String(1))
            // window.location.reload()
        }
        new_element.textContent = "Убрать"
        new_element.href = window.location
        info.appendChild(new_element)
    }

</script>
</body>

</html>
