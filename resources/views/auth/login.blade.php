@extends('layouts.basic')

@section('title')
    Авторизация
@endsection

@section('content')
    <section class="d-flex justify-content-center registration content">
        <form class="text-center my-5 " method="post" action="{{route('login.store')}}">
            @csrf
            <h1 class="my-2">Добро пожаловать</h1>
            <h5 class="my-4">Еще нет аккаунта? <a href="{{route('register')}}" class="myA">Создай его</a></h5>
            <input type="tel" placeholder="Ваш номер телефона"
                   value="{{old('phone')}}"
                   name="phone_number"
                   {{--                   pattern="\+7\s?\(?[0-9]{3}\)?\s?[0-9]{3}-?[0-9]{2}-?[0-9]{2}"--}}
                   class="w-75 border-0 myGrey rounded my-1 p-1 mySize20 @error('phone_number') is-invalid @enderror"
                   required>
            @error('phone_number')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror


            <input type="password" name="password" placeholder="Ваш пароль"
                   class="w-75 border-0 myGrey  rounded my-1 p-1 mySize20 @error('password') is-invalid @enderror">
            @error('password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <div>
                <button class=" w-75 rounded-4 mySize20 myLightBlue text-white p-2 border-0 m-2">Войти</button>
            </div>
            <a href="NumberLogin.html" class="myA">Забыли пароль?</a>
        </form>
    </section>
@endsection
