@extends('layouts.basic')

@section('title')
    Избранное
@endsection

@section('content')
    <div class="catalog">
        <section class="m-5px catalog">
            <h1>Избранное</h1>

            @if ($favourites->count() > 0)
                <div class="row row-cols-1 row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 my-3">
                    @foreach($favourites as $favourite)
                        @php
                            $product = $favourite->product;
                        @endphp
                        @if($product)

                            <x-product-card :product="$product"/>

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
