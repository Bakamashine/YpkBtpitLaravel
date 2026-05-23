@extends('layouts.basic')

@section('title')
    Страница редактирования
@endsection

@section('content')
    <div class="catalog content">
        <section class="m-5 catalog text-center">
            <h1>Редактировать услуги и товары</h1>
            <input class="form-control" type="search" placeholder="Поиск" aria-label="Поиск" style="height: 60px;">

            <div class="row row-cols-1 row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 my-3">
                @forelse ($products as $product)
                    <div class="col d-flex">
                        <div class="rounded shadow p-3 w-100 d-flex flex-column">
                            <img src="{{ get_image_or_default($product->photo_path) }}" class="card-img-top"
                                alt="{{ $product->product_name }}">
                            <div class="card-body catalog d-flex flex-column">
                                <h3 class="card-title">{{ $product->product_name }}</h3>
                                <h5>Исполнитель: {{ $product->user->name ?? 'Не указан' }}</h5>
                                <h4>{{ $product->product_cost }} руб.</h4>
                                <p>{{ $product->product_info }}</p>

                                <div class="mt-auto d-flex flex-column gap-2">
                                    <a href="{{ route('product.edit', $product) }}" class="text-decoration-none">
                                        <button type="button"
                                            class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                                            <span>Редактировать</span>
                                        </button>
                                    </a>

                                    <form action="{{ route('product.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Вы уверены, что хотите удалить этот товар/услугу?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="sign-out d-flex bg-danger border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                                            <span>Удалить</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">Нет товаров или услуг для отображения.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </section>
    </div>
@endsection
