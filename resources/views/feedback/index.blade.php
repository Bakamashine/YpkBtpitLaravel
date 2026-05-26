@extends('layouts.basic')

@section('title')
    Все отзывы
@endsection

@section('content')
    <div class="reviews content">
        <section class="m-3 reviews">
            <h1>Отзывы наших клиентов</h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 my-2">
                @forelse ($feedbacks as $feedback)
                    <div class="col d-flex">
                        <div class="rounded shadow p-3 w-100 bg-white">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <img alt="avatar" class="rounded-circle" height="50" width="50"
                                     src="{{ get_image_or_default($feedback->user->avatar) }}"
                                     style="object-fit: cover;">
                                <div>
                                    <h6 class="mb-0">{{ $feedback->user->name }}</h6>
                                    <div class="text-warning small">
                                        <span>{{ str_repeat('★', $feedback->rating) }}{{ str_repeat('☆', 5 - $feedback->rating) }}</span>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0 text-secondary small">{{ $feedback->comment }}</p>
                            <small class="text-muted d-block mt-1">{{ $feedback->created_at->translatedFormat('j F Y') }}</small>
                            @isAdmin
                                <form action="{{ route('feedback.destroy', $feedback) }}" method="POST"
                                      class="mt-2" onsubmit="return confirm('Удалить отзыв?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Удалить</button>
                                </form>
                            @endisAdmin
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Пока нет отзывов</p>
                    </div>
                @endforelse
            </div>

            @if ($feedbacks->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        </section>
    </div>
@endsection
