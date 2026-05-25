@extends('layouts.basic')
@section("title")
    Главная
@endsection

@section("content")
    <div class="catalog content">
        <section class="m-5 catalog">
            <h1>Услуги и товары</h1>
            @if (count($products) > 0)
                <div class="row row-cols-1 row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 my-3">
                    @foreach($products as $product)
                        <div class="col d-flex">
                            <div class="rounded shadow p-3 w-100">
                                <img
                                    src="{{ get_image_or_default($product->photo_path) }}"
                                    class="card-img-top" alt="{{ $product->product_name }}">
                                <div class="card-body catalog">
                                    <h3 class="card-title h5">{{ $product->product_name }}</h3>
                                    <h5 class="text-muted small">
                                        Исполнитель: {{ $product->user->name ?? 'Не указан' }}
                                    </h5>
                                    <h4 class="text-primary my-2">{{ $product->product_cost }} Р</h4>
                                    <p class="text-muted small text-truncate">{{ $product->product_info }}</p>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('product.show', $product) }}"
                                       class="text-decoration-none flex-grow-1">
                                        <button type="button"
                                                class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center p-2 text-white w-100">
                                            <span>подробнее</span>
                                        </button>
                                    </a>

                                    @auth
                                        @php
                                            $isFavorited = in_array($product->id, $favoritedProductIds);
                                        @endphp

                                        @if ($isFavorited)
                                            <form action="{{ route('favourite.destroy', $product) }}" method="POST"
                                                  class="m-0 p-0 d-inline-block lh-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border-0 bg-transparent p-0"
                                                        title="Убрать из избранного">
                                                    <div class="heart-wrapper is-favorited">
                                                        <img src="{{ asset('img/greyHeart.png') }}" alt="Серый"
                                                             class="heart-hover like">
                                                        <img src="{{ asset('img/redHeart.png') }}" alt="Красный"
                                                             class="heart-default like">
                                                    </div>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('favourite.store') }}" method="POST"
                                                  class="m-0 p-0 d-inline-block lh-1">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="border-0 bg-transparent p-0"
                                                        title="Добавить в избранное">
                                                    <div class="heart-wrapper">
                                                        <img src="{{ asset('img/greyHeart.png') }}" alt="Серый"
                                                             class="heart-default like">
                                                        <img src="{{ asset('img/redHeart.png') }}" alt="Красный"
                                                             class="heart-hover like">
                                                    </div>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flexCenter">
                    {{ $products->links() }}
                </div>
            @else
                <p class="text-center">Товаров нет</p>
            @endif
        </section>
    </div>
@endsection
