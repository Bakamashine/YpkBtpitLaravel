@extends('layouts.basic')

@section('title')
    {{ $product->is_product ? 'Купить' : 'Заказать' }} — {{ $product->product_name }}
@endsection

@section('content')
    <section class="catalog content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="myInfoCard catalog addProduct p-4">
                        <div class="text-center mb-4">
                            <img src="{{ get_image_or_default($product->photo_path) }}"
                                 class="img-fluid rounded-4 mb-3" alt="{{ $product->product_name }}"
                                 style="max-height: 200px; object-fit: contain;">
                            <h2>{{ $product->product_name }}</h2>
                            <h4 class="text-primary">{{ $product->product_cost }} руб.</h4>
                            <span class="badge bg-secondary fs-6">
                                {{ $product->is_product ? 'Товар' : 'Услуга' }}
                            </span>
                        </div>

                        <hr>

                        <form method="POST" action="{{ route('order.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="mb-3">
                                <label for="customers_comment" class="form-label">
                                    {{ $product->is_product ? 'Комментарий к покупке' : 'Детали заказа' }}
                                </label>
                                <textarea name="customers_comment" id="customers_comment" rows="5"
                                          class="form-control @error('customers_comment') is-invalid @enderror"
                                          placeholder="Укажите удобное время, адрес доставки или другие пожелания...">{{ old('customers_comment') }}</textarea>
                                @error('customers_comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-3">
                                <button type="submit"
                                        class="btn btn-primary flex-grow-1 py-2">
                                    {{ $product->is_product ? 'Купить' : 'Заказать' }}
                                </button>
                                <a href="{{ route('product.show', $product) }}"
                                   class="btn btn-outline-secondary">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
