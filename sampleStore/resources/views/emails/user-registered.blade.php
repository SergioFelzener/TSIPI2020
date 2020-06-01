<img style="width: 100px;" src="../../../assets/img/Logo01_Black.svg"><br>

<h1>Olá, {{ $user->name }} ! </h1>

    <h2>Obrigado pelo seu cadastro</h2>

<p>Faça bom proveito e excelentes compras em nosso Mundo Musical<br>
    Seu email de cadastro é: <strong>{{ $user->email }}</strong> <br>
    Sua senha : <strong> por questões de segurança nunca enviamos senhas</strong><br><br>
    <hr>
    Confirme seu email para ter acesso ao nosso Mercado da Musica
</p>

<hr>
Email enviado em {{ date('d/m/Y H:i:s') }}.
