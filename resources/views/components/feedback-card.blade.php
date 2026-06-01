@props(['feedback'])

<div class="col d-flex">
    <div class="card shadow border-0 rounded-3 w-100">
        <div class="card-body">
            <div class="d-flex align-items-center gap-3 mb-3">
                <img alt="avatar" class="rounded-circle" height="50" width="50"
                     src="{{ get_image_or_default($feedback->user->avatar) }}"
                     style="object-fit: cover;">
                <div>
                    <h6 class="mb-0 fw-semibold">{{ $feedback->user->name }}</h6>
                    <div class="text-warning small lh-1">
                        <span>{{ str_repeat('★', $feedback->rating) }}{{ str_repeat('☆', 5 - $feedback->rating) }}</span>
                    </div>
                </div>
            </div>
            <p class="card-text mb-1 text-secondary">{{ $feedback->comment }}</p>
            <small class="text-muted">{{ $feedback->created_at->translatedFormat('j F Y') }}</small>
            @isManager
            <form action="{{ route('feedback.destroy', $feedback) }}" method="POST"
                  class="mt-3" onsubmit="return confirm('Удалить отзыв?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm w-100">Удалить</button>
            </form>
            <a href="{{ route('user.detail', $feedback->user) }}" class="text-decoration-none">
                <button type="button"
                        class="product-card-btn sign-out d-flex myLightBlue border-0 rounded-3 justify-content-center align-items-center p-2 text-white w-100 mt-2">
                    <span>О пользователе</span>
                </button>
            </a>
            @endisManager
        </div>
    </div>
</div>
