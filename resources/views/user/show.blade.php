@extends('layouts.basic')

@section('title')
    {{ $user->name }} — Профиль
@endsection

@section('content')
    <section class="catalog profile">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="myInfoCard catalog addProduct p-4">
                        <div class="text-center mb-4">
                            <img src="{{ get_image_or_default($user->avatar) }}"
                                 class="rounded-circle mb-3" alt="{{ $user->name }}"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                            <h2>{{ $user->name }}</h2>
                            @if($user->is_active)
                                <span class="badge bg-success">Активен</span>
                            @else
                                <span class="badge bg-danger">Неактивен</span>
                            @endif
                        </div>

                        <hr>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-1">Email</h6>
                                <p class="mb-0">{{ $user->email ?? 'Не указан' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-1">Телефон</h6>
                                <p class="mb-0">{{ $user->phone_number ?? 'Не указан' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-1">Роль</h6>
                                <p class="mb-0">{{ $user->role->role_name ?? 'Не назначена' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-1">Тип услуг</h6>
                                <p class="mb-0">{{ $user->ypk->ypk_name ?? 'Не указан' }}</p>
                            </div>
                            <div class="col-12">
                                <h6 class="text-muted text-uppercase mb-1">Дополнительная информация</h6>
                                <p class="mb-0">{{ $user->user_info }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-1">Регистрация</h6>
                                <p class="mb-0">{{ $user->created_at?->format('d.m.Y H:i') ?? '—' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase mb-1">Последнее обновление</h6>
                                <p class="mb-0">{{ $user->updated_at?->format('d.m.Y H:i') ?? '—' }}</p>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex gap-3">
                            <a href="{{ route('user_edit') }}"
                               class="btn btn-primary flex-grow-1">
                                Редактировать профиль
                            </a>
                            <a href="{{ route('home') }}"
                               class="btn btn-outline-secondary">
                                Назад
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
