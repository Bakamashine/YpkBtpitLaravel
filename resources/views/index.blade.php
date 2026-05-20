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
                    @foreach($products as $value)
                        <div class="col d-flex">
                            <div class="rounded shadow p-3 w-100">
                                <img
                                    src="{{$value->photo_path ? asset('storage') . "/$value->photo_path" : asset('/img/default_image.jpg')}}"
                                    class="card-img-top" alt="{{$value->photo_path}}">
                                <div class="card-body catalog">
                                    <h3 class="card-title">Название: {{ $value->name }}</h3>
                                    {{--                                    <h5>Исполнитель</h5>--}}
                                    <h4>Цена: {{ $value->product_cost }} Р</h4>
                                    <p>{{$value->product_info}}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="info.html" class="w-100 mx-1 text-decoration-none">
                                        <button type="button"
                                                class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center p-2 text-white w-100">
                                            <span>подробнее</span>
                                        </button>
                                    </a>
                                    <form action="" class="m-0 p-0 d-inline-block lh-1">
                                        <button type="button" class="border-0 bg-transparent p-0">
                                            <img src="img/greyHear.png" alt="" class="like">
                                        </button>
                                    </form>
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
