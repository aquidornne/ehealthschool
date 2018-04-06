<div class="login text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <a href="<?php echo $this->webroot ?>">
                <img src="<?php echo $this->webroot; ?>img/logo.png" style="max-width: 160px;">
            </a>
        </div>
        <?php echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'password_recover_2', 'class' => 'm-t')); ?>
            <h3>Escolha uma nova senha para acesso ao sistema.</h3>
            <div id="password" class="form-group">
                <?php echo $this->Form->input('User.password', array('type' => 'password', 'div' => false, 'class' => 'form-control', 'label' => false, 'placeholder' => 'Digite sua senha', 'value' => '')); ?>
            </div>
            <div id="password_confirm" class="form-group">
                <?php echo $this->Form->input('User.password_confirm', array('type' => 'password', 'div' => false, 'class' => 'form-control', 'label' => false, 'placeholder' => 'Digite sua senha novamente')); ?>
            </div>

            <?php echo $this->Form->hidden('User.id', array('value' => $this->data['User']['id'])); ?>
            <?php echo $this->Form->hidden('User.role_id', array('value' => $this->data['User']['role_id'])); ?>
            <?php echo $this->Form->hidden('User.token', array('value' => $token)); ?>

            <?php echo $this->Form->submit('Recuperar senha', array('id' => 'btn_submit', 'class' => 'btn btn-primary block full-width m-b', 'div' => false));?>
        <?php echo $this->Form->end(); ?>
    </div>
    <div>
        <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'login')); ?>">Login</a>
    </div>
    <span><?php echo $this->Session->flash(); ?></span>
</div>

<script>
    $('#btn_submit').click(function (e){
        e.preventDefault();

        var error = [];

        if (!$('#UserPassword').val()) {
            application.inlineFieldAlert('add', 'input', $('#UserPassword'), 'Informe a senha.', 'warning', false);
            error.push(1);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#UserPassword'));
        }

        if (!$('#UserPasswordConfirm').val()) {
            application.inlineFieldAlert('add', 'input', $('#UserPasswordConfirm'), 'Informe a confirmação.', 'warning', false);
            error.push(2);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#UserPasswordConfirm'));
        }

        if ($('#UserPassword').val() != $('#UserPasswordConfirm').val()) {
            application.inlineFieldAlert('add', 'input', $('#UserPasswordConfirm'), 'As senhas devem ser idênticas.', 'warning', false);
            error.push(3);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#UserPasswordConfirm'));
        }

        if (error.length > 0) {
            toastr.warning('Dados inválidos no fomulário.');
            return false;
        } else {
            $('#UserPasswordRecover2Form').submit();
        }
    });
</script>