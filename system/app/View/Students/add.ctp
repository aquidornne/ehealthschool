<div class="row border-bottom white-bg dashboard-header">
    <h2 class="noMarginTop">Cadastrar Aluno</h2>
</div>

<div class="wrapper wrapper-content">
    <?php echo $this->Form->create(FALSE, array('id' => 'form_add', 'controller' => 'Students', 'action' => 'add', 'enctype' => 'multipart/form-data')); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Usuário</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('User.name', array('div' => false, 'label' => 'Nome', 'class' => 'form-control', 'placeholder' => 'Nome')); ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <div class="input-group marginBottomDefault">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <?php echo $this->Form->input('User.email', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'E-mail')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('User.password', array('type' => 'password', 'div' => false, 'label' => 'Senha:', 'class' => 'form-control', 'value' => '', 'placeholder' => 'Senha', 'autocomplete' => 'off')); ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('User.password_2', array('type' => 'password', 'div' => false, 'label' => 'Confirme a senha:', 'class' => 'form-control', 'value' => '', 'placeholder' => 'Confirme a senha', 'autocomplete' => 'off')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('User.eadbox_id', array('type' => 'text', 'div' => false, 'label' => 'Referência EADBox:', 'class' => 'form-control', 'placeholder' => 'Referência EADBox')); ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('User.cpf', array('div' => false, 'label' => 'CPF:', 'class' => 'form-control mask_cpf', 'placeholder' => 'CPF')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkbox">
                                    <label>
                                        <?php echo $this->Form->input('User.active', array('type' => 'checkbox', 'div' => false, 'label' => 'Permitir Login?', 'class' => 'minimal-red', 'value' => 1, 'checked' => true)); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="col-sm-4 pull-right">
                        <?php echo $this->Form->hidden('User.role_id', array('value' => 2)); ?>
                        <a href="<?php echo $this->Html->url(array('controller' => 'Students', 'action' => 'index')); ?>" class="btn btn-default" type="submit">Cancelar</a>
                        <?php echo $this->Form->submit('Salvar', array('div' => FALSE, 'id' => 'btn_submit', 'class' => 'btn btn-primary')); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>

<script>
    $('#btn_submit').click(function (e) {
        e.preventDefault();

        var error = [];

        if (!$('#UserName').val()) {
            application.inlineFieldAlert('add', 'input', $('#UserName'), 'Informe o nome.', 'warning', false);
            error.push(1);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#UserName'));
        }

        if (!$('#UserEmail').val()) {
            application.inlineFieldAlert('add', 'input-prepend', $('#UserEmail'), 'Informe o e-mail.', 'warning', false);
            error.push(2);
        } else {
            application.inlineFieldAlert('clean', 'input-prepend', $('#UserEmail'));
        }

        if ($('#UserPassword').val() != $('#UserPassword2').val()) {
            application.inlineFieldAlert('add', 'input', $('#UserPassword'), 'As senhas devem ser identicas.', 'warning', false);
            application.inlineFieldAlert('add', 'input', $('#UserPassword2'), 'As senhas devem ser identicas.', 'warning', false);
            error.push(4);
        } else {
            if ($('#UserPassword').val().length < 6) {
                application.inlineFieldAlert('add', 'input', $('#UserPassword'), 'A senha deve ser superior a 6 dígitos.', 'warning', false);
                error.push(5);
            } else {
                application.inlineFieldAlert('clean', 'input', $('#UserPassword'));
            }

            if ($('#UserPassword2').val().length < 6) {
                application.inlineFieldAlert('add', 'input', $('#UserPassword2'), 'A senha deve ser superior a 6 dígitos.', 'warning', false);
                error.push(6);
            } else {
                application.inlineFieldAlert('clean', 'input', $('#UserPassword2'));
            }
        }

        if (!$('#UserCpf').val()) {
            application.inlineFieldAlert('add', 'input', $('#UserCpf'), 'Informe o CPF.', 'warning', false);
            error.push(7);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#UserCpf'));
        }

        console.log(error);

        if (error.length > 0) {
            toastr.warning('Dados inválidos no fomulário.');
            return false;
        } else {
            $('#form_add').submit();
        }
    });
</script>