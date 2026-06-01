@extends('layouts.basic')
@section("title")
    Главная
@endsection

@section("content")
    <div class="catalog content">
        <section class="m-5px catalog">
            <h1>Услуги и товары</h1>
            @if (count($products) > 0)
                <div class="row row-cols-1 row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 my-3">
                    @foreach($products as $product)

                        <x-product-card :product="$product"/>
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
