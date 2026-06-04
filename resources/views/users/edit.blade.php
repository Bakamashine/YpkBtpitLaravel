@extends('layouts.basic')

@section('title')
    Редактирование пользователя {{ $user->name }}
@endsection

@section('content')
    <section class="catalog profile">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-4">
                            <h4 class="card-title mb-4">Редактировать пользователя</h4>

                            <form method="POST" action="{{ route('user_management.update', $user) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="text-center mb-4">
                                    <label for="avatar" class="d-inline-block" style="cursor: pointer;">
                                        <img id="avatarPreview"
                                             src="{{ get_image_or_default($user->avatar) }}"
                                             class="rounded-circle border" alt="Аватар"
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                        <div class="small text-muted mt-1">Нажмите, чтобы загрузить новый аватар</div>
                                    </label>
                                    <input type="file" name="avatar" id="avatar" accept="image/*" hidden>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">ФИО <span
                                            class="text-danger">*</span></label>
                                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Введите ФИО">
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label fw-semibold">Номер телефона <span
                                            class="text-danger">*</span></label>
                                    <input id="phone_number" type="tel" name="phone_number"
                                           value="{{ old('phone_number', $user->phone_number) }}"
                                           class="form-control @error('phone_number') is-invalid @enderror"
                                           placeholder="Введите номер телефона" inputmode="numeric">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Введите email">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Новый пароль</label>
                                    <input id="password" type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Оставьте пустым, чтобы сохранить текущий">
                                    <div class="form-text">Минимум 8 символов. Требуется только при смене пароля.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="role_id" class="form-label fw-semibold">Роль <span
                                            class="text-danger">*</span></label>
                                    <select id="role_id" name="role_id"
                                            class="form-select @error('role_id') is-invalid @enderror">
                                        <option selected disabled>Выберите роль</option>
                                        @foreach ($roles as $role)
                                            <option
                                                value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>
                                                {{ $role->role_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="ypk_id" class="form-label fw-semibold">Тип УПК</label>
                                    <select id="ypk_id" name="ypk_id"
                                            class="form-select @error('ypk_id') is-invalid @enderror">
                                        <option value="" @empty(old('ypk_id', $user->ypk_id)) selected @endempty>Не
                                            указано
                                        </option>
                                        @foreach ($ypks as $ypk)
                                            <option
                                                value="{{ $ypk->id }}" @selected(old('ypk_id', $user->ypk_id) == $ypk->id)>
                                                {{ $ypk->ypk_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="user_info" class="form-label fw-semibold">Дополнительная
                                        информация</label>
                                    <textarea id="user_info" name="user_info" rows="3"
                                              class="form-control @error('user_info') is-invalid @enderror"
                                              placeholder="Введите дополнительную информацию">{{ old('user_info', $user->user_info) }}</textarea>
                                </div>

                                <div class="mb-4 form-check">
                                    <input type="checkbox" name="is_active" id="is_active" value="1"
                                           class="form-check-input @error('is_active') is-invalid @enderror"
                                        @checked(old('is_active', $user->is_active))>
                                    <label class="form-check-label" for="is_active">Пользователь активен</label>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('user_management.index') }}" class="btn btn-secondary">Отмена</a>
                                    <button type="submit" class="btn btn-primary px-4">Сохранить изменения</button>
                                </div>

                                <hr class="my-4">

                                <form action="{{ route('user_management.toggle-active', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->is_active)
                                        <button type="submit" class="btn btn-outline-danger w-100"
                                                onclick="return confirm('Вы уверены, что хотите деактивировать пользователя?')">
                                            Деактивировать пользователя
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-outline-success w-100">
                                            Активировать пользователя
                                        </button>
                                    @endif
                                </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let id = "avatar";
        let preview = "avatarPreview";
    </script>
    <script src="{{ asset('js/photoInput.js') }}"></script>
@endsection
