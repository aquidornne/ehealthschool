<style type="text/css">
    * {
        font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif;
        color: #333;
    }
    h2 {
        font-size: 14pt;
        color: #0088cc !important;
    }
</style>

<h2>Recuperação de senha</h2>
<p>
    Olá,<br>
    Você solicitou recuperação de senha em nosso sistema.<br>
    Segue abaixo, link para finalização do processo.<br>
    <a href="<?php echo Router::fullBaseUrl() . $this->webroot . 'Users/password_recover_2/' . $token; ?>">Recuperar senha</a>
</p>