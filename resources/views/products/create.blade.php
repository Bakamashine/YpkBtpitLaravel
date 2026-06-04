@extends('layouts.basic')

@section('title')
    Создать продукт или услугу
@endsection

@section('content')
    <section class="catalog profile">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-4">
                            <h4 class="card-title mb-4">Добавить новое</h4>

                            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="text-center mb-4">
                                    <label for="photoInput" class="d-inline-block" style="cursor: pointer;">
                                        <div
                                            class="rounded-3 bg-secondary d-flex justify-content-center align-items-center mx-auto"
                                            style="width: 200px; height: 200px; overflow: hidden;">
                                            <img id="photoPreview"
                                                 src="{{ asset('img/material-symbols_add-a-photo-outline-sharp.png') }}"
                                                 class="w-100 h-100" style="object-fit: cover;"
                                                 alt="Изображение товара">
                                        </div>
                                        <div class="small text-muted mt-1">Нажмите, чтобы загрузить фото</div>
                                    </label>
                                    <input type="file" name="photo_path" accept="image/*" hidden id="photoInput">
                                </div>

                                <div class="mb-3">
                                    <label for="product_name" class="form-label fw-semibold">Название <span
                                            class="text-danger">*</span></label>
                                    <input id="product_name" type="text" name="product_name"
                                           value="{{ old('product_name') }}"
                                           class="form-control @error('product_name') is-invalid @enderror"
                                           placeholder="Название товара или услуги">
                                </div>

                                <div class="mb-3">
                                    <label for="product_cost" class="form-label fw-semibold">Стоимость <span
                                            class="text-danger">*</span></label>
                                    <input id="product_cost" type="text" name="product_cost"
                                           value="{{ old('product_cost') }}"
                                           class="form-control @error('product_cost') is-invalid @enderror"
                                           placeholder="Стоимость в рублях">
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label fw-semibold">Адрес</label>
                                    <input id="address" type="text" name="address" value="{{ old('address') }}"
                                           class="form-control @error('address') is-invalid @enderror"
                                           placeholder="Адрес">
                                </div>

                                <div class="mb-3">
                                    <label for="ypk_id" class="form-label fw-semibold">Тип <span
                                            class="text-danger">*</span></label>
                                    <select id="ypk_id" name="ypk_id"
                                            class="form-select @error('ypk_id') is-invalid @enderror">
                                        <option selected disabled>Выберите тип</option>
                                        @foreach ($ypks as $ypk)
                                            <option value="{{ $ypk->id }}" @selected(old('ypk_id') == $ypk->id)>
                                                {{ $ypk->ypk_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="status_product_id" class="form-label fw-semibold">Статус <span
                                            class="text-danger">*</span></label>
                                    <select id="status_product_id" name="status_product_id"
                                            class="form-select @error('status_product_id') is-invalid @enderror">
                                        <option selected disabled>Выберите статус</option>
                                        @foreach ($statusProducts as $status)
                                            <option
                                                value="{{ $status->id }}" @selected(old('status_product_id') == $status->id)>
                                                {{ $status->status_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="product_info" class="form-label fw-semibold">Описание</label>
                                    <textarea id="product_info" name="product_info" rows="3"
                                              class="form-control @error('product_info') is-invalid @enderror"
                                              placeholder="Дополнительная информация">{{ old('product_info') }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Тип <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_product" id="service"
                                                   value="0" @checked(old('is_product', '0') == '0')>
                                            <label class="form-check-label" for="service">Услуга</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_product" id="product"
                                                   value="1" @checked(old('is_product', '1') == '1')>
                                            <label class="form-check-label" for="product">Товар</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('main') }}" class="btn btn-secondary">Отмена</a>
                                    <button type="submit" class="btn btn-primary px-4">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('photoInput').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('photoPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
