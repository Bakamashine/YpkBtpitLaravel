@extends('layouts.basic')

@section('title')
    Создание нового пользователя
@endsection

@section('content')
    <div class="text-center">
        <h1>Создать нового пользователя</h1>
    </div>
    <section class="catalog content">


        <form method="POST" action="{{ route('user_management.store') }}" enctype="multipart/form-data" class="my-5">
            @csrf
            <div class="mx-auto" style="max-width: 600px;">
                <div class="d-flex align-items-start gap-4 mb-4">
                    <label for="avatar">
                        <img id="avatarPreview" src="{{ get_image_or_default(null) }}" class="avatar" alt="Аватар">
                    </label>
                    <input type="file" name="avatar" id="avatar" accept="image/*" hidden>
                    <div class="text-muted small">Нажмите на изображение, чтобы загрузить аватар</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">ФИО <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Введите ФИО">
                </div>

                <div class="mb-3">
                    <label class="form-label">Номер телефона <span class="text-danger">*</span></label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}"
                           class="form-control @error('phone_number') is-invalid @enderror"
                           placeholder="Введите номер телефона" inputmode="numeric">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Введите email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Пароль <span class="text-danger">*</span></label>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Минимум 8 символов">
                </div>

                <div class="mb-3">
                    <label class="form-label">Роль <span class="text-danger">*</span></label>
                    <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                        <option selected disabled>Выберите роль</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Тип УПК</label>
                    <select name="ypk_id" class="form-select @error('ypk_id') is-invalid @enderror">
                        <option selected disabled>Выберите тип УПК (необязательно)</option>
                        @foreach ($ypks as $ypk)
                            <option value="{{ $ypk->id }}" @selected(old('ypk_id') == $ypk->id)>
                                {{ $ypk->ypk_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Дополнительная информация</label>
                    <textarea name="user_info" rows="3"
                              class="form-control @error('user_info') is-invalid @enderror"
                              placeholder="Введите дополнительную информацию">{{ old('user_info') }}</textarea>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           class="form-check-input @error('is_active') is-invalid @enderror"
                        @checked(old('is_active', true))>
                    <label class="form-check-label" for="is_active">Пользователь активен</label>
                </div>

                <div class="d-flex gap-3">
                    <a href="{{ route('user_management.index') }}" class="btn btn-outline-secondary">Отмена</a>
                    <button type="submit" class="btn btn-dark">Создать пользователя</button>
                </div>
            </div>
        </form>
    </section>

    <script>
        let id = "avatar";
        let preview = "avatarPreview";
    </script>
    <script src="{{ asset('js/photoInput.js') }}"></script>
@endsection
