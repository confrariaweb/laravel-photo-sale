<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">
</head>
<body class="text-center" id="page-login">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form class="form-signin" method="POST" action="{{ route('login') }}">
    @csrf
    <img class="mb-4" src="{{ asset('brand/bootstrap-solid.svg') }}" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Olá, vamos logar</h1>
    <label for="inputEmail" class="sr-only">E-mail</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Seu e-mail" name="email" value="{{ old('email') }}" required autofocus>
    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Sua senha" name="password" required autocomplete="current-password">
    <div class="checkbox mb-3">
        <label>
            <input id="remember_me" type="checkbox" class="" name="remember">
            Lembre-se de mim
        </label>
    </div>
    <button class="btn btn-sm btn-primary btn-block" type="submit">Entrar</button>
    <a class="btn btn-sm btn-primary btn-block" href="{{ route('socialite.redirect', ['driver' => 'facebook']) }}">Facebook</a>
    <a class="btn btn-sm btn-primary btn-block" href="#">Instagram</a>
    @if (Route::has('password.request'))
        <label>
            <a class="" href="{{ route('password.request') }}">
                {{ __('Esqueceu sua senha?') }}
            </a>
        </label>
    @endif
    <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }} </p>
</form>
</body>
</html>