@extends('layouts.basic')

@section('title')
    Домашняя страница
@endsection

@section('content')
    <section class="catalog profile">
        <!-- профиль -->
        <div class="m-3">
            <div class="d-flex align-items-center justify-content-between">
                <img id="avatar_image"
                     src="{{ get_image_or_default($current_user->avatar) }}"
                     class="avatar" alt="...">
                <div class="mx-3" style="flex: 1;">
                    <h5><b>Фио: </b>{{ $current_user->name }}</h5>
                    <hr style="width: 100%; margin: 0;">
                    <p><b>Номер телефона: </b>{{ $current_user->phone_number }}</p>
                    <hr style="width: 100%; margin: 0;">
                    <p><b>Доп информация: </b>{{ $current_user->user_info }}</p>
                    <hr style="width: 100%; margin: 0;">
                </div>
            </div>
            <div class="container-fluid px-2 px-md-3">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-3 my-3">

                    <!-- Левая группа кнопок (основные действия) -->
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2 gap-md-3">

                        <!-- общие данные -->
                        <a href="{{ route('user.detail') }}" class="text-decoration-none flex-grow-1 flex-md-grow-0">
                            <button type="button"
                                    class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                                <span>Подробнее</span>
                            </button>
                        </a>
                        <a href="{{ route('user_edit') }}" class="text-decoration-none flex-grow-1 flex-md-grow-0">
                            <button type="button"
                                    class="sign-out d-flex edit justify-content-center align-items-center gap-2 p-2 text-white w-100">
                                <span>Ваши данные</span>
                                <img src="{{ asset('/img/edit.png') }}" alt="" class="profileButton"
                                     style="width: 16px; height: 16px;">
                            </button>
                        </a>
                        <!-- ======================= Исполнитель кнопки======================= -->
                        @isManager
                        <!-- добавь товары/услуги -->
                        <a href="{{ route('product.create') }}" class="text-decoration-none flex-grow-1 flex-md-grow-0">
                            <button type="button"
                                    class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                                <span>Добавить товары/услуги</span>
                            </button>
                        </a>
                        <!-- ======================= Админ кнопки ======================= -->
                        <!-- Редактировать товары/услуги -->
                        <a href="{{ route('product.edit_page') }}"
                           class="text-decoration-none flex-grow-1 flex-md-grow-0">
                            <button type="button"
                                    class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                                <span>Редактировать товары/услуги</span>
                            </button>
                        </a>


                        <!-- Управление заказами -->
                        <a href="{{route('order_management.index')}}" class="text-decoration-none flex-grow-1 flex-md-grow-0">
                            <button type="button"
                                    class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                                <span>Управление заказами</span>
                            </button>
                        </a>
                        @endisManager


                        @isAdmin
                        <!-- Управление пользователями -->
                        <a href="{{ route('user_management.index') }}"
                           class="text-decoration-none flex-grow-1 flex-md-grow-0">
                            <button type="button"
                                    class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                                <span>Управление пользователями</span>
                            </button>
                        </a>
                        @endisAdmin

                        <!-- оставить отзыв после хотя 1 оказанной услуги -->
                        <a href="{{route('feedback.create')}}" class="text-decoration-none flex-grow-1 flex-md-grow-0">
                            <button type="button"
                                    class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                                <span>Оставить отзыв</span>
                            </button>
                        </a>
                    </div>

                    <!-- Правая группа (выход) -->
                    <form class="flex-shrink-0" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button
                            class="sign-out d-flex btn btn-outline-danger justify-content-center align-items-center gap-2 w-100 w-md-auto">
                            <span>Выйти из аккаунта</span>
                            <img src="{{asset('img/sign-out.png')}}" alt="" class="profileButton"
                                 style="width: 16px; height: 16px;">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ======================= Заказы обычного пользователя ======================= -->
        <section class="order">
            <div class="myBlue rounded-3 d-flex justify-content-between align-items-center">
                <h1 class="p-3 text-white nameBlock mb-0">Заказы</h1>
                @isManager
                    <a href="{{ route('order_management.index') }}" class="btn btn-light btn-sm me-3">
                        Управление заказами
                    </a>
                @endisManager
            </div>

            @if($orders->count() == 0)
                <p class="text-center">Заказов нет</p>
            @else
                <div class="m-5px row row-cols-1 row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 my-3">
                    @foreach($orders as $value)
                        <x-order-card :order="$value" :select_status="false" />
                    @endforeach
                </div>

            @endif
        </section>

        @isManager
        <!-- ======================= товары и услуги редактора/исполнителя ======================= -->
        <section>
            <div class="myBlue rounded-3">
                <h1 class="p-3 text-white nameBlock">Ваши товары и услуги</h1>
            </div>

            @if($favourite_products->count() == 0)
                <p class="text-center">Ваших товаров или услуг нет</p>
            @else
                <div class="m-5px row row-cols-1 row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 my-3">


                    @foreach($favourite_products as $value)
                        <x-product-card :product="$value" :like_button="false"/>
                    @endforeach
                </div>
            @endif
        </section>
        @endisManager

        @isAdmin
        <!-- ======================= ШТУКИ АДМИНА!!!!!!!!!!!!!!!!  ======================= -->
        <!-- Добавить новый тип услуг/продуктов -->
        <section>
            <div class="myBlue rounded-3">
                <h1 class="p-3 text-white nameBlock">Добавить новый тип услуг/продуктов</h1>
            </div>
            <form action="{{ route('ypk.store') }}" method="post" class="d-flex gap-2 mb-3">
                @csrf
                <div class="w-75">
                    <input name="ypk_name" type="text" placeholder="Введите новый тип услуги или продукта"
                           class=" border-0 rounded-4 backColorGre1 p-3 w-100 @error('ypk_name') is-invalid @enderror"
                           style="height: 100%;">
                </div>
                <div class="w-25">
                    <button
                        class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100 h-100">
                        <span>Добавить</span>
                    </button>
                </div>
            </form>
        </section>
        <!-- Удалить тип услуг/продуктов -->
        <form action="{{ route('ypk.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="myBlue rounded-3">
                <h1 class="p-3 text-white nameBlock">Удалить тип услуг/продуктов</h1>
            </div>
            <div class="d-flex gap-2 mb-3">
                <div class="w-75">
                    <select name="ypk_id" class=" border-0 rounded-4 backColorGre1 p-3 w-100 text-muted"
                            style="height: 100%;">
                        <option value="" disabled selected>Выберите тип услуги или продукта</option>
                        @if (count($ypk) > 0)
                            @foreach ($ypk as $value)
                                <option value="{{ $value->id }}">{{ $value->ypk_name }}</option>
                            @endforeach
                        @else
                            <option></option>
                        @endif
                    </select>
                </div>
                <div class="w-25">
                    <button type="submit"
                            class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100 h-100">
                        <span>Удалить</span>
                    </button>
                </div>
            </div>
        </form>
    </section>
    @endisAdmin

@endsection
