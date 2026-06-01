@extends('layouts.basic')

@section('title')
    Редактирование {{ $user->name }}
@endsection

@section('content')
    <section class="catalog profile">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-4">
                            <h4 class="card-title mb-4">Редактирование профиля</h4>

                            <form method="post" action="{{ route('user_edit.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="text-center mb-4">
                                    <label for="avatar" class="d-inline-block" style="cursor: pointer;">
                                        <img id="avatarPreview"
                                             src="{{ get_image_or_default($user->avatar) }}"
                                             class="rounded-circle border" alt="Аватар"
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                        <div class="small text-muted mt-1">Нажмите, чтобы изменить фото</div>
                                    </label>
                                    <input type="file" name="avatar" id="avatar" accept="image/*" hidden>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">ФИО</label>
                                    <input id="name" value="{{ old('name', $user->name) }}" name="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Введите ФИО">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input id="email" value="{{ old('email', $user->email) }}" name="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Введите email">
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label fw-semibold">Номер телефона</label>
                                    <input id="phone_number" type="tel" name="phone_number"
                                           value="{{ old('phone_number', $user->phone_number) }}"
                                           class="form-control @error('phone_number') is-invalid @enderror"
                                           placeholder="Введите номер телефона" inputmode="numeric"
                                           pattern="[0-9+\-\s]+">
                                </div>

                                <div class="mb-4">
                                    <label for="user_info" class="form-label fw-semibold">Дополнительная информация</label>
                                    <input id="user_info" type="text" name="user_info"
                                           value="{{ old('user_info', $user->user_info) }}"
                                           class="form-control @error('user_info') is-invalid @enderror"
                                           placeholder="Введите информацию">
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('home') }}" class="btn btn-secondary">Отмена</a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        Сохранить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let id = "avatar"
        let preview = "avatarPreview"
    </script>
    <script src="{{ asset('js/photoInput.js') }}"></script>
@endsection
