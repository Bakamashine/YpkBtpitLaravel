{{--
 * Компонент карточки товара/услуги с кнопками "Редактировать" и "Удалить".
 *
 * @param \App\Models\Product $product Объект товара или услуги.
--}}
@props(['product'])

<div class="col d-flex">
    <div class="rounded shadow p-3 w-100 d-flex flex-column">
        <img src="{{ get_image_or_default($product->photo_path) }}" class="card-img-top"
             alt="{{ $product->product_name }}">
        <div class="card-body catalog d-flex flex-column">
            <h3 class="card-title">Название: {{ $product->product_name }}</h3>
            <h5>Исполнитель: {{ $product->user->name ?? 'Не указан' }}</h5>
            <h4>Цена: {{ $product->product_cost }} руб.</h4>
            <p>Описание: {{ $product->product_info }}</p>
            <p>{{$product->is_product ? "Продукт" : "Услуга"}}</p>
            <div class="mt-auto d-flex flex-column gap-2">

                @isAdmin
                <a href="{{ route('product.edit', $product) }}" class="text-decoration-none">
                    <button type="button"
                            class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                        <span>Редактировать</span>
                    </button>
                </a>

                <form action="{{ route('product.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('Вы уверены, что хотите удалить этот товар/услугу?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="sign-out d-flex bg-danger border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                        <span>Удалить</span>
                    </button>
                </form>
                @endisAdmin
                <a href="{{ route('product.show', $product) }}" class="text-decoration-none">
                    <button type="button"
                            class="sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center p-2 text-white w-100">
                        <span>Подробнее</span>
                    </button>
                </a>


                @if(Auth::user() &&  $product->favourite->contains('user_id', Auth::user()->id))
                    <form action="{{ route('favourite.destroy', $product) }}" method="POST"
                          class="m-0 p-0 d-inline-block lh-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 bg-transparent p-0"
                                title="Убрать из избранного">
                            <div class="heart-wrapper is-favorited">
                                <img src="{{ asset('img/redHeart.png') }}" alt="Красный"
                                     class="heart-default like">
                                <img src="{{ asset('img/greyHeart.png') }}" alt="Серый"
                                     class="heart-hover like">

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
            </div>

        </div>
    </div>
</div>
