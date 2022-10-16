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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Telefone com DDD</label>
                            <input type="text" class="form-control" id="login-email" name="login-email" placeholder="(99) 9999-9999" aria-describedby="login-email" tabindex="1" autofocus="">
                        </div>
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Nome completo</label>
                            <input type="text" class="form-control" id="login-email" name="login-email" placeholder="Francisco Almeida" aria-describedby="login-email" tabindex="1" autofocus="">
                        </div>
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="login-email" name="login-email" placeholder="seu-email@hotmail.com" aria-describedby="login-email" tabindex="1" autofocus="">
                        </div>
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Senha</label>
                            <input type="text" class="form-control" id="login-email" name="login-email" placeholder="********" aria-describedby="login-email" tabindex="1" autofocus="">
                        </div>
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Confirmar senha</label>
                            <input type="text" class="form-control" id="login-email" name="login-email" placeholder="********" aria-describedby="login-email" tabindex="1" autofocus="">
                        </div>
                    </form>

                    <p class="text-center mt-2">
                        <span>Já possui um cadastro?</span>
                        <a href="/login">
                            <span>Acessar minha conta</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
    @if(config('settings.reCaptchStatus'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endsection
