@extends('layouts.app')

@section('title-page')
    Страница регистрации
@endsection

@section('content')
    <main class="form-signin">
        <form method="post" action="{{ route('login') }}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Введите данные</h1>

            <div class="form-floating">
                <input name="name" type="text" class="form-control" id="floatingInput" placeholder="логин">
                @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror

            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="пароль">
                @error('password')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
            <p class="mt-5 mb-3 text-muted">© 2017–2022</p>
        </form>
    </main>
@endsection