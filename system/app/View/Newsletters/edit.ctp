<div class="row border-bottom white-bg dashboard-header">
    <h2 class="noMarginTop">Editar Contato</h2>
    <?php //echo $this->element('breadcrumb'); ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <?php echo $this->Form->create('Newsletter', array('id' => 'form_edit', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal m-t-md')); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Professor</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" style="">
                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label">Dados do Professor</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <label class="control-label">Nome</label>
                                    <?php echo $this->Form->input('name', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'Nome')); ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <label class="control-label">Telefone</label>
                                    <?php echo $this->Form->input('phone', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'Telefone')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b">
                                    <label class="control-label">E-mail</label>
                                    <?php echo $this->Form->input('email', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'E-mail')); ?>
                                </div>
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
                    <?php echo $this->Form->hidden('id', array('value' => $this->data['Newsletter']['id'])); ?>

                    <a href="<?php echo $this->Html->url(array('action' => 'index')); ?>" class="btn btn-default" type="submit">Cancelar</a>
                    <?php echo $this->Form->submit('Salvar', array('div' => FALSE, 'id' => 'btn_submit', 'class' => 'btn btn-primary')); ?>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>

<script>
    $('#btn_submit').click(function (e){
        e.preventDefault();

        var error = [];

        if (!$('#NewsletterName').val()) {
            application.inlineFieldAlert('add', 'input', $('#NewsletterName'), 'Informe o nome.', 'warning', false);
            error.push(1);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#NewsletterName'));
        }

        if (!$('#NewsletterEmail').val()) {
            application.inlineFieldAlert('add', 'input', $('#NewsletterEmail'), 'Informe a e-mail.', 'warning', false);
            error.push(2);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#NewsletterEmail'));
        }

        console.log(error);

        if (error.length > 0) {
            toastr.warning('Dados inválidos no fomulário.');
            return false;
        } else {
            $('#form_edit').submit();
        }
    });
</script>