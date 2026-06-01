@extends('layouts.basic')

@section('title')
    Все отзывы
@endsection

@section('content')
    <div class="reviews">
        <section class="m-3 reviews">
            <h1>Отзывы наших клиентов</h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 my-2">
                @forelse ($feedbacks as $feedback)
                    <x-feedback-card :feedback="$feedback" />
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
