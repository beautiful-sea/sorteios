@extends('layouts.app')
@section('page-style')
    <style>
        label, h4, p {
            color: white!important;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card  mb-0" style="    background: #10163a">
                <div class="card-body">
                    <a href="/" class="brand-logo d-flex justify-content-center">
                       <img src="/images/logo_sorteio1.png" style="width: max-content">
                    </a>

                    <h4 class="card-title mb-1">Seja bem-vindo! 👋</h4>
                    <p class="card-text mb-2">Por favor, faça login para acessar sua conta.</p>

                    <form class="auth-login-form mt-2" action="/login" method="POST" novalidate="novalidate">
                        @csrf
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="login-email" name="email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus="">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">Senha</label>
                                <a href="/forgot-password">
                                    <small>Esqueceu sua senha?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="············" aria-describedby="login-password">
                                <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <button class="btn btn-primary w-100 waves-effect waves-float waves-light" tabindex="4">Entrar</button>
                    </form>

                    <p class="text-center mt-2">
                        <span>Novo na plataforma?</span>
                        <a href="/register">
                            <span>Criar uma conta</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
