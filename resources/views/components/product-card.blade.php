@props(['product', 'like_button' => true])

<div class="col d-flex">
    <div class="rounded shadow w-100 d-flex flex-column overflow-hidden">
        <div class="product-card-img" style="height: 200px; overflow: hidden;">
            <img src="{{ get_image_or_default($product->photo_path) }}"
                 class="w-100 h-100 object-fit"
                 alt="{{ $product->product_name }}">
        </div>
        <div class="p-3 d-flex flex-column flex-grow-1 catalog">
            <h5 class="fw-bold mb-2">{{ $product->product_name }}</h5>
            <h6 class="text-muted mb-1">Исполнитель: {{ $product->user->name ?? 'Не указан' }}</h6>
            <h5 class="fw-bold mb-2">{{ $product->product_cost }} руб.</h5>
            <p class="text-muted small mb-1">{{ Str::limit($product->product_info, 100) }}</p>
            <div class="mb-2">
                <span class="badge bg-secondary">{{ $product->is_product ? "Продукт" : "Услуга" }}</span>
            </div>
            <div class="mt-auto d-flex flex-column gap-2">
                @isManager
                <a href="{{ route('product.edit', $product) }}" class="text-decoration-none">
                    <button type="button"
                            class="product-card-btn sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                        <span>Редактировать</span>
                    </button>
                </a>

                <form action="{{ route('product.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('Вы уверены, что хотите удалить этот товар/услугу?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="product-card-btn sign-out d-flex bg-danger border-0 rounded-3 justify-content-center align-items-center gap-2 p-2 text-white w-100">
                        <span>Удалить</span>
                    </button>
                </form>
                @endisManager

                <a href="{{ route('product.show', $product) }}" class="text-decoration-none">
                    <button type="button"
                            class="product-card-btn sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center p-2 text-white w-100">
                        <span>Подробнее</span>
                    </button>
                </a>


                @if($like_button)
                    @if( Auth::user() && $product->favourite->contains('user_id', Auth::user()->id))
                        <form action="{{ route('favourite.destroy', $product) }}" method="POST"
                              class="m-0 p-0 flexCenter lh-1">
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
                              class="m-0 p-0 flexCenter lh-1">
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
                @endif
            </div>
        </div>
    </div>
</div>
