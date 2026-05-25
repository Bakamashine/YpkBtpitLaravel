@extends('layouts.basic')

@section('title')
    Редактировать {{ $product->product_name }}
@endsection

@section('content')
    <section class="mx-4">
        <div class="text-center">
            <h1>Редактировать</h1>
        </div>
        <form method="POST" action="{{ route('product.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="myInfoCard catalog addProduct d-flex align-items-center justify-content-center">
                <div class="mb-3">
                    <div class="newTovar">
                        <div class="card-body text-center ">
                            <label
                                for="photoInput"
                                class="m-3 newFoto rounded-5 bg-secondary d-flex justify-content-center align-items-center">
                                <img id="photoPreview"
                                     src="{{ $product->photo_path ? get_image_or_default($product->photo_path) : '/img/material-symbols_add-a-photo-outline-sharp.png' }}"
                                     class="w-25" alt="Изображение товара">
                            </label>
                            <input type="file" name="photo_path" accept="image/*" hidden id="photoInput">
                            @error('photo_path')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <div class="my-5">
                                <div class="mb-3">
                                    <input type="text" name="product_name" placeholder="Название"
                                           value="{{ old('product_name', $product->product_name) }}"
                                           class="border-0 rounded-4 backColorGre1 w-100 px-3 @error('product_name') is-invalid @enderror">
                                    @error('product_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="product_cost" placeholder="Стоимость"
                                           value="{{ old('product_cost', $product->product_cost) }}"
                                           class="border-0 rounded-4 backColorGre1 w-100 px-3 @error('product_cost') is-invalid @enderror">
                                    @error('product_cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="address" placeholder="Адрес"
                                           value="{{ old('address', $product->address) }}"
                                           class="border-0 rounded-4 backColorGre1 w-100 px-3 @error('address') is-invalid @enderror">
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <select name="ypk_id"
                                            class="border-0 rounded-4 backColorGre1 w-100 px-3 text-muted @error('ypk_id') is-invalid @enderror">
                                        <option selected disabled>Тип: выпадающий список</option>
                                        @foreach ($ypks as $ypk)
                                            <option
                                                value="{{ $ypk->id }}" @selected(old('ypk_id', $product->ypk_id) == $ypk->id)>
                                                {{ $ypk->ypk_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('ypk_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <select name="status_product_id"
                                            class="border-0 rounded-4 backColorGre1 w-100 px-3 text-muted @error('status_product_id') is-invalid @enderror">
                                        <option selected disabled>Статус</option>
                                        @foreach ($statusProducts as $status)
                                            <option
                                                value="{{ $status->id }}" @selected(old('status_product_id', $product->status_product_id) == $status->id)>
                                                {{ $status->status_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <textarea name="product_info" placeholder="Доп инфа" rows="3"
                                              class="border-0 rounded-4 backColorGre1 w-100 px-3 @error('product_info') is-invalid @enderror">{{ old('product_info', $product->product_info) }}</textarea>
                                    @error('product_info')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4 d-flex justify-content-around gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_product" id="service"
                                               value="0" @checked(old('is_product', $product->is_product) == 0)>
                                        <label class="form-check-label text-muted" for="service">Услуга</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_product" id="product"
                                               value="1" @checked(old('is_product', $product->is_product) == 1)>
                                        <label class="form-check-label text-muted" for="product">Товар</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-50 myButton rounded-4 myBlue text-white p-2">Обновить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script src="{{ asset('js/photoInput.js') }}"></script>
@endsection
