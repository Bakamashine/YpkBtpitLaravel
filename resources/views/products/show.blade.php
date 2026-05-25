@extends('layouts.basic')

@section('title')
    {{ $product->product_name }}
@endsection

@section('content')
    <section class="mx-4">
        <div class="myInfoCard catalog addProduct d-flex align-items-center justify-content-center">
            <div class="mb-3">
                <div class="newTovar">
                    <div class="card-body text-center">
                        @if ($product->photo_path)
                            <img src="{{ get_image_or_default($product->photo_path) }}" class="img-fluid rounded-4 mb-3"
                                alt="{{ $product->product_name }}">
                        @endif
                        <h1>{{ $product->product_name }}</h1>
                        <p class="text-muted">{{ $product->product_info }}</p>
                        <p><strong>Стоимость:</strong> {{ $product->product_cost }}</p>
                        <p><strong>Адрес:</strong> {{ $product->address }}</p>
                        <p><strong>Тип:</strong> {{ $product->is_product ? 'Товар' : 'Услуга' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
