<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>{{ config('app.name') }} | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

    <!-- Login CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>

<body style="background-image: url('images/login_bg.jpg');">

<div class="container d-flex justify-content-center align-items-center ">

    <div class="login">
        <img src="{{ asset('images/logo-ferola.png')}}">

        <div class="card">
            <div class="card-header">
                <h3>Login</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <ul class="list-unstyled msg-error">
                                <li><small><i class="fas fa-asterisk"></i> {{ $error }}</small></li>
                            </ul>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('login') }}" method="post" id="formLogin">
                    @csrf

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
                        </div>
                        <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                               placeholder="usuário">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@ferola.com.br</span>
                        </div>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                        </div>
                        <input type="password" name="password" id="password" class="form-control" placeholder="senha">
                    </div>
                    <div class="row align-items-center remember">
                        <input type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Lembrar-me') }}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn float-right login_btn">
                            Entrar <i class="fas fa-sign-in-alt"></i>
                        </button>
                    </div>
                </form>
            </div>
            @if (Route::has('password.request'))
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('password.request') }}" class="text-white"><small>esqueceu sua senha?</small></a>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $('form').submit(function () {
        $('button[type=submit] i').removeClass();
        $('button[type=submit] i').addClass('fas fa-spinner fa-spin');
        $('button[type=submit]').attr('disabled', 'true');
    });
</script>
</body>

</html>
