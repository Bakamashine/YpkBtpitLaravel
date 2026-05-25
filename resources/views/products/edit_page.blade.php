@extends('layouts.basic')

@section('title')
    Страница редактирования
@endsection

@section('content')
    <div class="catalog content">
        <section class="m-5 catalog text-center">
            <h1>Редактировать услуги и товары</h1>
            <form method="get" class="d-flex gap-2">
                <input name="search" value="{{ request('search') }}" class="form-control" type="search"
                       placeholder="Поиск по названию, описанию или адресу" aria-label="Поиск" style="height: 60px;">
                <button type="submit" class="btn btn-dark px-4" style="height: 60px;">Найти</button>
                @if(request('search'))
                    <a href="{{ route('product.edit_page') }}" class="btn btn-outline-secondary"
                       style="height: 60px; display: flex; align-items: center;">Сбросить</a>
                @endif
            </form>

            <div class="row row-cols-1 row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 my-3">
                @forelse ($products as $product)
                    <x-product-card :product="$product"/>
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
