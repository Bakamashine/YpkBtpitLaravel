<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">

    <title>@yield("title") :: {{env("APP_NAME")}}</title>
</head>
<body>
<section class="myColorHeader">
    @auth
        <p class="mb-0 pt-2 text-center">Добро пожаловать, {{ auth()->user()->name }}</p>
    @endauth

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid flex-nowrap">
            <a class="navbar-brand" href="/">
                <img src="/img/logo.png" alt="Логотип" class="myImg" />
            </a>

            <div class="mySearh flex-grow-1 mx-3">
                <input class="form-control" type="search" placeholder="Поиск" aria-label="Поиск" />
            </div>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <img src="/img/Group 2.png" alt="Меню" style="width: 30px;" />
            </button>

            <div class="d-none d-lg-flex align-items-center">
                <div class="myIcons">
                    <div class="d-flex me-3 myStyleTextLogo header-icons align-items-center">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Вход</a>
                            <a href="{{ route('register') }}" class="btn btn-light btn-sm me-2">Регистрация</a>
                        @endguest
                        @auth
                            <div class="mx-1 text-center">
                                <a href="{{ route('logout') }}" class="text-decoration-none"
                                   onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                    <img class="header__image__size header__image-logout" src="/img/logout.png" alt="Выход" />
                                    <p class="header__button__text">Выйти</p>
                                </a>
                                <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endauth
                        <div class="mx-1 text-center">
                            <a href="college.html">
                                <img class="header__image__size" src="/img/material-symbols_info-outline-rounded1.png" alt="Информация" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Меню</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav flex-column">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 py-2" href="{{ route('login') }}">
                                    <span>Вход</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 py-2" href="{{ route('register') }}">
                                    <span>Регистрация</span>
                                </a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 py-2" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form-offcanvas').submit();">
                                    <img src="/img/logout.png" alt="Выход" style="width: 24px;" />
                                    <span>Выйти</span>
                                </a>
                                <form id="logout-form-offcanvas" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 py-2" href="college.html">
                                <img src="/img/material-symbols_info-outline-rounded1.png" alt="Информация" style="width: 24px;" />
                                <span>Информация</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</section>

<main>
    @yield('content')
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

<script src="{{asset("/js/bootstrap.bundle.min.js")}}"></script>
</body>
</html>
