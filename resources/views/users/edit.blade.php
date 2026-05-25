@extends('layouts.basic')

@section('title')
    Редактирование пользователя {{ $user->name }}
@endsection

@section('content')
    <div class="text-center">
        <h1>Редактировать пользователя</h1>
    </div>
    <section class="catalog content">


        <form method="POST" action="{{ route('user_management.update', $user) }}" enctype="multipart/form-data"
              class="my-5">
            @csrf
            @method('PUT')

            <div class="mx-auto" style="max-width: 600px;">
                <div class="d-flex align-items-start gap-4 mb-4">
                    <label for="avatar">
                        <img id="avatarPreview" src="{{ get_image_or_default($user->avatar) }}" class="avatar"
                             alt="Аватар">
                    </label>
                    <input type="file" name="avatar" id="avatar" accept="image/*" hidden>
                    <div class="text-muted small">Нажмите на изображение, чтобы загрузить новый аватар</div>
                </div>
                @error('avatar')
                <div class="text-danger small mb-3">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label">ФИО <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Введите ФИО">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Номер телефона <span class="text-danger">*</span></label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                           class="form-control @error('phone_number') is-invalid @enderror"
                           placeholder="Введите номер телефона" inputmode="numeric">
                    @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Введите email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Новый пароль</label>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Оставьте пустым, чтобы сохранить текущий">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text text-muted">Минимум 8 символов. Требуется только при смене пароля.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Роль <span class="text-danger">*</span></label>
                    <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                        <option selected disabled>Выберите роль</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Тип УПК</label>
                    <select name="ypk_id" class="form-select @error('ypk_id') is-invalid @enderror">
                        <option value="" @empty(old('ypk_id', $user->ypk_id)) selected @endempty>Не указано</option>
                        @foreach ($ypks as $ypk)
                            <option value="{{ $ypk->id }}" @selected(old('ypk_id', $user->ypk_id) == $ypk->id)>
                                {{ $ypk->ypk_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('ypk_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Дополнительная информация</label>
                    <textarea name="user_info" rows="3"
                              class="form-control @error('user_info') is-invalid @enderror"
                              placeholder="Введите дополнительную информацию">{{ old('user_info', $user->user_info) }}</textarea>
                    @error('user_info')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           class="form-check-input @error('is_active') is-invalid @enderror"
                        @checked(old('is_active', $user->is_active))>
                    <label class="form-check-label" for="is_active">Пользователь активен</label>
                    @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-3">
                    <a href="{{ route('user_management.index') }}" class="btn btn-outline-secondary">Отмена</a>
                    <button type="submit" class="btn btn-dark">Сохранить изменения</button>
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
