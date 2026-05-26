@extends('layouts.basic')

@section('title')
    Создать отзыв
@endsection

@section('content')
    <section class="mx-4 catalog profile">
        <div>
            <div class="text-center">
                <h1>Оставить отзыв</h1>
            </div>
            <div class="myInfoCard catalog addProduct d-flex align-items-center justify-content-center">
                <div class="mb-3">
                    <form method="POST" action="{{ route('feedback.store') }}" class="newTovar">
                        @csrf
                        <div class="card-body text-center">

                            <div class="mb-3">
                                <select name="rating"
                                        class="border-0 rounded-4 backColorGre1 w-100 px-3 text-muted @error('rating') is-invalid @enderror">
                                    <option selected disabled>Оценка</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                            <textarea name="comment"
                                      class="border-0 rounded-4 backColorGre1 w-100 px-3 @error('comment') is-invalid @enderror"
                                      placeholder="Комментарий" rows="6">{{ old('comment') }}</textarea>
                                @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="w-50 myButton rounded-4 myBlue text-white p-2">Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
