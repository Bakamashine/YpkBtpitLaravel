@props(['order', 'statuses' => null, 'select_status' => true])

<div class="col d-flex">
    <div class="rounded shadow w-100 d-flex flex-column overflow-hidden">
        <div class="product-card-img" style="height: 200px; overflow: hidden;">
            <img src="{{ get_image_or_default($order->product->photo_path) }}"
                 class="w-100 h-100 object-fit" alt="...">
        </div>
        <div class="p-3 d-flex flex-column flex-grow-1 catalog">
            <h5 class="fw-bold mb-2">{{ $order->product->product_name }}</h5>
            <h6 class="text-muted mb-1">{{ $order->product->user->name ?? 'Исполнитель' }}</h6>
            <h5 class="fw-bold mb-2">{{ $order->product->product_cost }} руб.</h5>
            <p class="text-muted small mb-1">{{ $order->date?->format('d.m.Y') }}</p>
            <p class="text-muted small mb-1">{{ $order->statusOrder->status_name ?? 'Статус' }}</p>
            <p class="text-muted small mb-0">{{ $order->product->user->phone_number ?? 'Телефон' }}</p>

            @if($select_status)
                @isManager
                <hr class="my-2">
                <form method="POST" action="{{ route('order_management.update-status', $order) }}"
                      onclick="event.stopPropagation()">
                    @csrf
                    @method('PATCH')
                    <div class="input-group input-group-sm">
                        <select name="status_order_id" class="form-select form-select-sm">
                            @foreach($statuses ?? \App\Models\StatusOrder::all() as $status)
                                <option value="{{ $status->id }}"
                                    {{ $order->status_order_id === $status->id ? 'selected' : '' }}>
                                    {{ $status->status_name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-primary btn-sm" type="submit">OK</button>
                    </div>
                </form>

                @endisManager
            @endif
            @auth
                <div class="my-2">
                    <a href="{{route('order.show', $order)}}" class="btn btn-info text-white">Подробнее</a>
                </div>
            @endauth
        </div>
    </div>
</div>
