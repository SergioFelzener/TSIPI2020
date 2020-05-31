@extends('layouts.app')

@section('content')
<div class="sign-container">

    <div class="sign">

        <div class="side">

            <img src="../assets/img/03A.svg" alt="Logo simpler">

        </div>

        <form method="POST" action="{{ route('register') }}" class="inputs">
            @csrf

            <h1>Registrar</h1>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-field">
                <input placeholder="Nome" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>

            <div class="input-field">
                <input placeholder="E-mail" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>

            <div class="input-field">
                <input placeholder="Senha" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            </div>

            <div class="input-field">
                <input placeholder="Confirme sua senha" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>



            <button type="submit" class="btn-primary">Registrar</button>

            <div class="link-field">
                <span>Já possui uma conta ?</span>
                <a href="{{ route('login') }}" class="login">Entre aqui</a>
            </div>


        </form>

    </div>

</div>
@endsection
