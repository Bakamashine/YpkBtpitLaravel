@extends('layouts.basic')

@section('title')
    {{ $product->product_name }}
@endsection

@section('content')
    <section class="catalog content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="myInfoCard catalog addProduct p-4">
                        <div class="text-center mb-4">
                            <img src="{{ get_image_or_default($product->photo_path) }}"
                                class="img-fluid rounded-4 mb-3" alt="{{ $product->product_name }}"
                                style="max-height: 400px; object-fit: contain;">
                        </div>

                        <div class="mb-5">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h1 class="h2 mb-0">{{ $product->product_name }}</h1>
                                <span class="badge bg-secondary fs-6">
                                    {{ $product->is_product ? 'Товар' : 'Услуга' }}
                                </span>
                            </div>
                            <h3 class="text-primary my-4">{{ $product->product_cost }} руб.</h3>
                        </div>

                        <hr>

                        <div class="my-4">
                            <h5 class="mb-3">Описание</h5>
                            <p class="text-muted">{{ $product->product_info }}</p>
                        </div>

                        <hr>

                        <div class="row my-4 g-4">
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-2">Исполнитель</h6>
                                <p class="mb-0">
                                    {{ $product->user->name ?? 'Не указан' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-2">Адрес</h6>
                                <p class="mb-0">{{ $product->address }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-2">Категория</h6>
                                <p class="mb-0">
                                    {{ $product->ypk->ypk_name ?? 'Не указана' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-2">Статус</h6>
                                <p class="mb-0">
                                    <span class="badge bg-secondary">
                                        {{ $product->statusProduct->status_name ?? 'Не указан' }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex gap-3 mt-4">
                            @auth
                                @php
                                    $isFavorited = Auth::user()
                                        ->favourite()
                                        ->where('product_id', $product->id)
                                        ->exists();
                                @endphp

                                @if ($isFavorited)
                                    <form action="{{ route('favourite.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger d-flex align-items-center gap-2">
                                            <img src="{{ asset('img/redHeart.png') }}" alt="В избранном" style="width: 24px;">
                                            <span>В избранном</span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favourite.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-outline-secondary favourite-btn d-flex align-items-center gap-2" title="Добавить в избранное">
                                            <img src="{{ asset('img/greyHeart.png') }}" alt="В избранное" class="like" style="width: 24px;">
                                            <span>Добавить в избранное</span>
                                        </button>
                                    </form>
                                @endif
                            @endauth

                            <a href="{{ route('main') }}" class="btn btn-outline-secondary ms-auto">
                                Назад к каталогу
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
