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
                    <x-product-card :product="$product" />
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
