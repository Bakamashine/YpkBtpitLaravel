@extends('layouts.basic')

@section('title')
    Избранное
@endsection

@section('content')
    <div class="catalog content">
        <section class="m-5 catalog">
            <h1>Избранное</h1>

            @if ($favourites->count() > 0)
                <div class="row row-cols-1 row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 my-3">
                    @foreach($favourites as $favourite)
                        @php
                            $product = $favourite->product;
                        @endphp
                        @if($product)
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
                                        <a href="{{ route('product.show', $product) }}" class="text-decoration-none flex-grow-1">
                                            <button type="button"
                                                    class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center p-2 text-white w-100">
                                                <span>подробнее</span>
                                            </button>
                                        </a>

                                        <form action="{{ route('favourite.destroy', $product) }}" method="POST" class="m-0 p-0 d-inline-block lh-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent p-0" title="Убрать из избранного">
                                                <div class="heart-wrapper is-favorited">
                                                    <img src="{{ asset('img/greyHeart.png') }}" alt="Серый" class="heart-hover like">
                                                    <img src="{{ asset('img/redHeart.png') }}" alt="Красный" class="heart-default like">
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $favourites->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <img src="{{ asset('img/greyHeart.png') }}" alt="" class="mb-3" style="width: 64px; opacity: 0.5;">
                    <p class="text-muted">У вас пока нет избранных товаров или услуг</p>
                    <a href="{{ route('main') }}" class="btn btn-outline-secondary mt-2">Вернуться в каталог</a>
                </div>
            @endif
        </section>
    </div>
@endsection
