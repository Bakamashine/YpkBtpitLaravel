@extends('layouts.basic')

@section('title')
    Создать отзыв
@endsection

@section('content')
    <section class="catalog profile">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-4">
                            <h4 class="card-title mb-4">Оставить отзыв</h4>

                            <form method="POST" action="{{ route('feedback.store') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="rating" class="form-label fw-semibold">Оценка <span class="text-danger">*</span></label>
                                    <select id="rating" name="rating"
                                            class="form-select @error('rating') is-invalid @enderror">
                                        <option selected disabled>Выберите оценку</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="comment" class="form-label fw-semibold">Комментарий <span
                                            class="text-danger">*</span></label>
                                    <textarea id="comment" name="comment" rows="6"
                                              class="form-control @error('comment') is-invalid @enderror"
                                              placeholder="Напишите ваш отзыв">{{ old('comment') }}</textarea>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Назад</a>
                                    <button type="submit" class="btn btn-primary px-4">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
