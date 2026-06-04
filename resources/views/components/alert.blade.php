@props(['errors' => null])

@php
    $hasErrors = $errors && $errors->any();
    $hasBanned = session('banned');
    $hasMessage = session('message');
    $hasSuccess = session('success');
    $hasError = session('error');
@endphp

@if($hasBanned || $hasMessage || $hasSuccess || $hasError || $hasErrors)
    <div class="alert-slide-wrapper">
        @if($hasBanned)
            <div
                class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between"
                role="alert">
                <span>{{ session('banned') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($hasError)
            <div
                class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between"
                role="alert">
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($hasMessage)
            <div
                class="alert alert-warning alert-dismissible fade show d-flex align-items-center justify-content-between"
                role="alert">
                <span>{{ session('message') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($hasErrors)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ошибка входа:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($hasSuccess)
            <div
                class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between"
                role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
@endif
