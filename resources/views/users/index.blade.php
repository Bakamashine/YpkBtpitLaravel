@extends('layouts.basic')

@section('title')
    Редактирование пользователей
@endsection

@section('content')
    <div class="catalog content">
        <section class="catalog">
            <div class="text-center">
                <h1>Управление пользователями</h1>
                <form method="get" class="d-flex gap-2 mt-3">
                    <input name="search" value="{{ request('search') }}" class="form-control" type="search" placeholder="Поиск по имени, телефону, email или информации" aria-label="Поиск" style="height: 60px;">
                    <button type="submit" class="btn btn-dark px-4" style="height: 60px;">Найти</button>
                    @if(request('search'))
                        <a href="{{ route('user_management.index') }}" class="btn btn-outline-secondary" style="height: 60px; display: flex; align-items: center;">Сбросить</a>
                    @endif
                </form>
            </div>

            <div class="my-5 w-100">
                <a href="{{route('user_management.create')}}" class="btn btn-dark">Создать пользователя</a>
                @forelse ($users as $user)
                    <div class="d-flex align-items-center justify-content-between my-3">
                        <img src="{{ get_image_or_default($user->avatar) }}" class="avatar" alt="...">
                        <div class="mx-3" style="flex: 1;">
                            <h5><b>Фио: </b>{{ $user->name }}</h5>
                            <hr style="width: 100%; margin: 0;">
                            <p><b>Номер телефона: </b>{{ $user->phone_number }}</p>
                            <hr style="width: 100%; margin: 0;">
                            <p><b>Доп информация: </b>{{ $user->user_info }}</p>
                            <hr style="width: 100%; margin: 0;">

                             <div class="d-flex align-items-center gap-2">
                                 <p class="me-2 mb-0">Роль:</p>
                                 <span class="badge bg-secondary">{{ $user->role?->role_name ?? 'Нет роли' }}</span>
                                 <a href="{{ route('user_management.edit', $user) }}" class="btn btn-sm btn-outline-primary ms-auto">Редактировать</a>
                                 <form action="{{ route('user_management.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить пользователя?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                                </form>
                            </div>
                            <hr style="width: 100%; margin: 0;">
                        </div>
                    </div>
                @empty
                    <p class="text-center">Пользователи не найдены</p>
                @endforelse
            </div>

            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </section>
    </div>
@endsection
