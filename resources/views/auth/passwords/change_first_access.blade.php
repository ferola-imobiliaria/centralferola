<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>{{ config('app.name') }} | Trocar senha</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>

<body style="background-image: url({{ asset('images/login_bg.jpg') }});">

<div class="container d-flex justify-content-center align-items-center ">

    <div class="login">
        <img src="{{ asset('images/logo-ferola.png') }}">

        <div class="card">
            <div class="card-header">
                <h3>Troca de senha</h3>
                <small class="text-white">É necessário que você troque a senha recebida,
                    por e-mail, para poder utilizar o sistema.</small>
            </div>
            <div class="card-body">

                @include('components.errors')

                <form action="{{ route('password.change.first.access') }}" method="post">
                    @csrf

                    <div class="input-group form-group">
                        <input type="password" class="form-control" name="current_password"
                               data-toggle="password"
                               data-message="Clique aqui para ver/ocultar a senha"
                               placeholder="Senha recebida por e-mail">
                    </div>

                    <div class="input-group form-group">
                        <input type="password" name="password" class="form-control"
                               data-toggle="password"
                               data-message="Clique aqui para ver/ocultar a senha"
                               placeholder="Nova senha">
                    </div>

                    <div class="input-group form-group">
                        <input type="password" name="password_confirmation" class="form-control"
                               data-toggle="password"
                               data-message="Clique aqui para ver/ocultar a senha"
                               placeholder="Repetir nova senha">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Trocar senha" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>

</html>

