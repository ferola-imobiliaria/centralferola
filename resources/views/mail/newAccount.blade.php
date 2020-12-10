@component('mail::message')
<h3>Seja bem-vindo! Você foi cadastrado no Sistema Ferola.</h3>
<p>Para fazer login no sistema utilize os dados abaixo:</p>
<p>Usuário: <b>{{ $user->username }}</b><br>Senha: <b>{{ $user->password_email }}</b></p>
<p>Lembre-se de alterar a sua senha após o primeiro acesso.</p>
<p>Qualquer dúvida sobre o uso do sistema, procure seu supervisor.</p>
@component('mail::button', [ 'url' => env('APP_URL'), 'color' => 'red'])
Clique aqui para acessar o sistema
@endcomponent
@endcomponent
