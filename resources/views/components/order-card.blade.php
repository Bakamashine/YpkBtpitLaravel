@props(['order'])

<div class="col d-flex">
    <a href="{{ route('user.detail', $order->user) }}"
       class="text-decoration-none text-black card-button w-100">
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
            </div>
        </div>
    </a>
</div>
