@extends('layouts.basic')


@section('title')
    Редактирование {{$user->name}}
@endsection

@section('content')
<section class="catalog  profile">
    <!-- профиль -->
    <form method="post" action="{{route('user_edit.update')}}" class="m-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="d-flex align-items-center justify-content-between">
            <label for="avatar"><img id="avatarPreview" src="{{get_image_or_default($user->avatar)}}" class=" avatar" alt="..."></label>
            <input type="file" name="avatar" id="avatar" accept="image/*" hidden>
            <div class="mx-3" style="flex: 1;">
                <h5><b>Фио: </b><input value="{{old('name', $user->name)}}" name="name" type="text"
                                       class="border-0 w-100 @error('name') is-invalid @enderror"
                                       placeholder="введите свое Фио">
                </h5>
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <hr style="width: 100%; margin: 0;">
                <p><b>Email: </b><input value="{{old('email', $user->email)}}" name="email" type="email"
                                        class="border-0 w-100 @error('email') is-invalid @enderror"
                                        placeholder="введите свой email"></p>
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <hr style="width: 100%; margin: 0;">
                <p><b>Номер телефона: </b><input type="tel" name="phone_number" value="{{old('phone_number', $user->phone_number)}}"
                                                 class="border-0 w-100 @error('phone_number') is-invalid @enderror"
                                                 placeholder="введите свой номер телефона" inputmode="numeric"
                                                 pattern="[0-9+\-\s]+"></p>
                @error('phone_number')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <hr style="width: 100%; margin: 0;">
                <p><b>Доп информация: </b><input type="text" name="user_info" value="{{old('user_info', $user->user_info)}}"
                                                 class="border-0 w-100 @error('user_info') is-invalid @enderror"
                                                 placeholder="введите информацию"></p>
                @error('user_info')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                <hr style="width: 100%; margin: 0;">
            </div>
        </div>
        <div class="d-flex justify-content-between m-3 align-items-center">
            <div class="d-flex ">
                    <button type="submit"
                            class="sign-out d-flex edit justify-content-evenly align-items-center gap-2 p-2 text-white ">
                        <span>Сохранить</span>
                        <img src="{{asset('/img/edit.png')}}" alt="" class="profileButton">
                    </button>
            </div>
        </div>
    </form>
</section>

<script>
    document.getElementById('avatar').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
