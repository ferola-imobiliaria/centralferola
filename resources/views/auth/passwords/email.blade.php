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

<body style="background-image: url('/images/login_bg.jpg');">

<div class="container d-flex justify-content-center align-items-center ">

    <div class="login">
        <img src="{{ asset('images/logo-ferola.png')}}">

        <div class="card">
            <div class="card-header">
                <h3>Redefinição de senha</h3>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <small>{{ session('status') }}</small>
                    </div>
                @endif
                @error('email')
                <div class="alert alert-danger" role="alert">

                    <ul class="list-unstyled msg-error">
                        <li><small><i class="fas fa-asterisk"></i> {{ $message }}</small></li>
                    </ul>

                </div>
                @enderror

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope text-white"></i></span>
                        </div>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" placeholder="e-mail" autocomplete="off" required autofocus>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-sm login_btn">
                            {{ __('Send Password Reset Link') }} <i class="fas fa-arrow-alt-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('login') }}" class="text-white">
                        <small>« voltar para o login</small>
                    </a>
                </div>
            </div>

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
