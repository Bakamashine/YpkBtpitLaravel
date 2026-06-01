@extends('layouts.basic')

@section('title')
    Заказ — {{ $order->product->product_name }}
@endsection

@section('content')
    <section class="catalog profile">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h4 class="fw-bold mb-1">{{ $order->product->product_name }}</h4>
                                    <span
                                        class="badge bg-secondary fs-6">{{ $order->product->is_product ? 'Товар' : 'Услуга' }}</span>
                                </div>
                                <span class="badge bg-info fs-6">{{ $order->statusOrder->status_name ?? '—' }}</span>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <img src="{{ get_image_or_default($order->product->photo_path) }}"
                                         class="img-fluid rounded-3 w-100" alt="{{ $order->product->product_name }}"
                                         style="max-height: 300px; object-fit: cover;">
                                </div>
                                <div class="col-md-6 d-flex flex-column justify-content-center">
                                    <h5 class="text-primary fw-bold">{{ number_format($order->product->product_cost, 0, ',', ' ') }}
                                        руб.</h5>
                                    <p class="mb-1"><strong>Дата
                                            заказа:</strong> {{ $order->date?->format('d.m.Y') ?? '—' }}</p>
                                    <p class="mb-1"><strong>Заказчик:</strong> {{ $order->customer->name ?? '—' }}</p>
                                    <p class="mb-0"><strong>Исполнитель:</strong> {{ $order->executor->name ?? '—' }}
                                    </p>
                                </div>
                            </div>

                            @if($order->customers_comment)
                                <div class="mb-4">
                                    <h6 class="fw-semibold">Комментарий заказчика:</h6>
                                    <p class="text-muted mb-0">{{ $order->customers_comment }}</p>
                                </div>
                            @endif

                            @if($order->user_comment)
                                <div class="mb-4">
                                    <h6 class="fw-semibold">Комментарий исполнителя:</h6>
                                    <p class="text-muted mb-0">{{ $order->user_comment }}</p>
                                </div>
                            @endif

                            @isManager
                            <hr>
                            <h6 class="fw-semibold mb-3">Управление статусом</h6>
                            <div class="d-flex gap-2">
                                <form method="POST" action="{{ route('order_management.update-status', $order) }}">
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
                                        <button type="submit" class="btn btn-warning text-white">Закрыть заказ</button>
                                    </form>
                                @endif
                            </div>
                            @endisManager

                            <div class="mt-4">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Назад</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
