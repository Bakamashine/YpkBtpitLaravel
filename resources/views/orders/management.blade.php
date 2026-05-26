@extends('layouts.basic')

@section('title')
    Управление заявками
@endsection

@section('content')
    <div class="catalog content">
        <section class="m-5 catalog">
            <h1 class="text-center mb-4">Редактировать статус заказов</h1>

            <x-alert/>


            <form method="get" class="d-flex gap-2 mt-3">
                <input name="search" value="{{ request('search') }}" class="form-control" type="search"
                       placeholder="Поиск по названию товара или заказчику" aria-label="Поиск"
                       style="height: 60px;">
                <button type="submit" class="btn btn-dark px-4" style="height: 60px;">Найти</button>
                @if(request('search'))
                    <a href="{{route('order_management.index')}}" class="btn btn-outline-secondary"
                       style="height: 60px; display: flex; align-items: center;">Сбросить</a>
                @endif
            </form>


            @empty($orders->items())
                <p class="text-center">Заявок нет</p>
            @else
                <div class="row row-cols-1 row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 my-3">
                    @foreach($orders as $order)
                        <div class="col d-flex">
                            <div class="rounded shadow p-3 w-100 d-flex flex-column">
                                <img src="{{ get_image_or_default($order->product->photo_path) }}" class="card-img-top"
                                     alt="{{ $order->product->product_name }}">
                                <div class="card-body catalog d-flex flex-column">
                                    <h3 class="card-title">{{ $order->product->product_name }}</h3>
                                    <h5>Заказчик: {{ $order->customer->name ?? 'Не указан' }}</h5>
                                    <h4>{{ $order->product->product_cost }} руб.</h4>
                                    <p>{{ Str::limit($order->product->product_info, 80) }}</p>
                                    <p class="text-muted small">
                                        Статус: <span
                                            class="badge bg-secondary">{{ $order->statusOrder->status_name ?? '—' }}</span>
                                    </p>
                                    <p class="text-muted small">Дата: {{ $order->date?->format('d.m.Y') ?? '—' }}</p>

                                    @if($order->customers_comment)
                                        <p class="text-muted small">
                                            Комментарий: {{ Str::limit($order->customers_comment, 60) }}
                                        </p>
                                    @endif

                                    <div class="mt-auto d-flex flex-column gap-2">
                                        <form method="POST"
                                              action="{{ route('order_management.update-status', $order) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="input-group">
                                                <select name="status_order_id" class="form-select">
                                                    @foreach($statuses as $status)
                                                        <option value="{{ $status->id }}"
                                                            {{ $order->status_order_id === $status->id ? 'selected' : '' }}>
                                                            {{ $status->status_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-outline-primary" type="submit">Применить</button>
                                            </div>
                                        </form>

                                        @if($order->statusOrder->status_name !== \App\Enums\StatusOrderEnum::Completed->value)
                                            <form method="POST" action="{{ route('order_management.close', $order) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="btn btn-warning text-white w-100">
                                                    Закрыть заказ
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            @endempty
        </section>
    </div>
@endsection
