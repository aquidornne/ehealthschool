<div class="row border-bottom white-bg dashboard-header">
    <h2 class="noMarginTop">Editar Conta</h2>
    <?php //echo $this->element('breadcrumb'); ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <?php echo $this->Form->create('Client', array('id' => 'form_edit', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal m-t-md')); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Cliente</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" style="">
                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label">Dados Principais</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">URL. Ex: dr_rodrigo</label>
                                    <?php echo $this->Form->input('url', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'URL')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Nome</label>
                                    <?php echo $this->Form->input('first_name', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'Nome')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Sobrenome</label>
                                    <?php echo $this->Form->input('last_name', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'Nome')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">CPF</label>
                                    <?php echo $this->Form->input('cpf', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control mask_cpf', 'placeholder' => 'CPF')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Data de nascimento</label>
                                    <?php echo $this->Form->input('birth', array('type' => 'text', 'div' => FALSE, 'label' => FALSE, 'class' => 'form-control mask_date datepicker', 'placeholder' => 'Data de nascimento')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">CRM</label>
                                    <?php echo $this->Form->input('crm', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'CRM')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">RQE</label>
                                    <?php echo $this->Form->input('rqe', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'RQE')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 m-b">
                                    <label class="control-label">Especialidades</label>
                                    <?php echo $this->Form->textarea('specialties', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control jqte', 'placeholder' => 'Especialidades')); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label">Informações de contato</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Telefone 1</label>
                                    <?php echo $this->Form->input('phone', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control mask_phone', 'placeholder' => 'Telefone 1')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Telefone 2</label>
                                    <?php echo $this->Form->input('phone_2', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control mask_phone', 'placeholder' => 'Telefone 2')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Telefone 3</label>
                                    <?php echo $this->Form->input('phone_3', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control mask_phone', 'placeholder' => 'Telefone 3')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">E-mail</label>
                                    <?php echo $this->Form->input('email', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'E-mail')); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label">Informações de conteúdo</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 m-b">
                                    <label class="control-label">Descrição/Sobre</label>
                                    <?php echo $this->Form->textarea('description', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control jqte', 'placeholder' => 'Descrição/Sobre')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 m-b">
                                    <div class="">
                                        <label class="control-label">Foto PNG</label>
                                        <input id="photo" type="file" name="data[Client][photo]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <?php if(!empty($this->data['Client']['photo'])){ ?>
                                        <a href="<?php echo $this->webroot . 'files/photos/' . $this->data['Client']['photo']; ?>" class="fancybox">
                                            <img src="<?php echo $this->webroot . 'files/photos/' . $this->data['Client']['photo']; ?>">
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 m-b">
                                    <div class="">
                                        <label class="control-label">Banner Mobile</label>
                                        <input id="banner_mobile" type="file" name="data[Client][banner_mobile]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <?php if(!empty($this->data['Client']['banner_mobile'])){ ?>
                                        <a href="<?php echo $this->webroot . 'files/banners/' . $this->data['Client']['banner_mobile']; ?>" class="fancybox">
                                            <img src="<?php echo $this->webroot . 'files/banners/' . $this->data['Client']['banner_mobile']; ?>">
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label">Endereço do consultório</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <div class="">
                                        <label class="control-label">CEP nº</label>
                                        <?php echo $this->Form->input('cep', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control mask_cep find_cep', 'number_parents' => '4', 'placeholder' => 'CEP nº')); ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-8 m-b">
                                    <div class="">
                                        <label class="control-label">Endereço completo</label>
                                        <?php echo $this->Form->input('address', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control autocomplete_address', 'placeholder' => 'Endereço completo')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <div class="">
                                        <label class="control-label">Selecione o Estado</label>
                                        <?php echo $this->Form->input('state', array('div' => FALSE, 'label' => FALSE, 'options' => $states, 'empty' => TRUE, 'class' => 'form-control chosen-select-deselect autocomplete_state', 'data-placeholder' => 'Selecione o Estado', 'placeholder' => 'Estado')); ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <div class="">
                                        <label class="control-label">Cidade</label>
                                        <?php echo $this->Form->input('city', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control autocomplete_city', 'placeholder' => 'Cidade')); ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <div class="">
                                        <label class="control-label">Bairro</label>
                                        <?php echo $this->Form->input('neighborhood', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control autocomplete_neighborhood', 'placeholder' => 'Bairro')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <div class="">
                                        <label class="control-label">Numero</label>
                                        <?php echo $this->Form->input('number', array('type' => 'number', 'min' => 0, 'div' => FALSE, 'label' => FALSE, 'class' => 'form-control autocomplete_city', 'placeholder' => 'Numero')); ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <div class="">
                                        <label class="control-label">Complemento</label>
                                        <?php echo $this->Form->input('complement', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control autocomplete_complement', 'placeholder' => 'Complemento')); ?>
                                    </div>
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

                    <?php echo $this->Form->hidden('id', array('value' => $id)); ?>
                    <?php echo $this->Form->hidden('photo_old', array('value' => $this->data['Client']['photo'])); ?>
                    <?php echo $this->Form->hidden('banner_mobile_old', array('value' => $this->data['Client']['banner_mobile'])); ?>
                    <?php echo $this->Form->hidden('url_current', array('value' => $url_current)); ?>

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

        if (!$('#ClientFirstName').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientFirstName'), 'Informe o primeiro nome.', 'warning', false);
            error.push(1);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientFirstName'));
        }

        if (!$('#ClientLastName').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientLastName'), 'Informe o sobrenome.', 'warning', false);
            error.push(2);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientLastName'));
        }

        if (!$('#ClientCpf').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientCpf'), 'Informe o CPF.', 'warning', false);
            error.push(3);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientCpf'));
        }

        if (!$('#ClientCrm').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientCrm'), 'Informe o CRM.', 'warning', false);
            error.push(4);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientCrm'));
        }

        if (!$('#ClientRqe').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientRqe'), 'Informe o RQE.', 'warning', false);
            error.push(5);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientRqe'));
        }

        if (!$('#ClientSpecialties').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientSpecialties'), 'Informe o RQE.', 'warning', false);
            error.push(6);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientSpecialties'));
        }

        if (!$('#ClientPhone').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientPhone'), 'Informe o telefone.', 'warning', false);
            error.push(7);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientPhone'));
        }

        if (!$('#ClientEmail').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientEmail'), 'Informe o e-mail.', 'warning', false);
            error.push(8);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientEmail'));
        }

        if (!$('#ClientBirth').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientBirth'), 'Informe a data de aniversário.', 'warning', false);
            error.push(9);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientBirth'));
        }

        if (!$('#ClientDescription').val()) {
            application.inlineFieldAlert('add', 'input-prepend', $('#ClientDescription'), 'Escreva a descrição.', 'warning', false);
            error.push(10);
        } else {
            application.inlineFieldAlert('clean', 'input-prepend', $('#ClientDescription'));
        }

        if (!$('#ClientCep').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientCep'), 'Informe o CEP.', 'warning', false);
            error.push(11);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientCep'));
        }

        if (!$('#ClientAddress').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientAddress'), 'Informe o endereço.', 'warning', false);
            error.push(12);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientAddress'));
        }

        if (!$('#ClientState').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientState'), 'Informe o estado.', 'warning', false);
            error.push(13);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientState'));
        }

        if (!$('#ClientCity').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientCity'), 'Informe a cidade.', 'warning', false);
            error.push(14);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientCity'));
        }

        if (!$('#ClientNeighborhood').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientNeighborhood'), 'Informe o bairro', 'warning', false);
            error.push(15);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientNeighborhood'));
        }

        if (!$('#ClientNumber').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientNumber'), 'Informe o numéro.', 'warning', false);
            error.push(16);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientNumber'));
        }

        if (!$('#ClientComplement').val()) {
            application.inlineFieldAlert('add', 'input', $('#ClientComplement'), 'Informe um complemento.', 'warning', false);
            error.push(17);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#ClientComplement'));
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