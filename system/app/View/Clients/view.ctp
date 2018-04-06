<div class="row border-bottom white-bg dashboard-header">
    <h2 class="noMarginTop">Conta</h2>
</div>

<div class="wrapper wrapper-content">
    <div class="row m-b">
        <div class="col-xs-12 col-md-8">
            <a href="<?php echo $this->Html->url(array('controller' => 'Services', 'action' => 'index', $id)); ?>" class="btn btn-primary"><i class="fa fa-heart"></i> Gerenciar Serviços</a>
            <a href="<?php echo $this->Html->url(array('controller' => 'Photos', 'action' => 'index', $id)); ?>" class="btn btn-primary"><i class="fa fa-file-image-o"></i> Gerenciar Fotos do Consultório</a>
            <a href="<?php echo $this->Html->url(array('controller' => 'Banners', 'action' => 'index', $id)); ?>" class="btn btn-primary"><i class="fa fa-file-image-o"></i> Gerenciar Banners</a>
        </div>
        <div class="col-xs-12 col-md-4 text-right">
            <a href="<?php echo $this->Html->url(array('controller' => 'Clients', 'action' => 'index')); ?>" class="btn btn-default"><i class="fa fa-mail-reply"></i></a>
            <a href="<?php echo $this->Html->url(array('controller' => 'Clients', 'action' => 'edit', $id)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i></a>
            <?php if($this->Session->read('Auth.User.role_id') == 1){ ?>
                <a href="<?php echo $this->Html->url(array('controller' => 'Clients', 'action' => 'remove', $id)); ?>" class="btn btn-danger confirm"><i class="fa fa-trash"></i></a>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Log</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Criador por: </b> <?php echo ((isset($users[$this->data['Client']['created_by']])) ? $users[$this->data['Client']['created_by']] : ''); ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Modificado por: </b> <?php echo ((isset($users[$this->data['Client']['modified_by']])) ? $users[$this->data['Client']['modified_by']] : ''); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Criado em: </b> <?php echo date('d-m-Y H:i', strtotime($this->data['Client']['created'])); ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Modificado em: </b> <?php echo date('d-m-Y H:i', strtotime($this->data['Client']['modified'])); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Informações</h5>
                        </div>
                        <div class="ibox-content">

                            <h2 class="m-b">Dados Principais</h2>

                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">URL: </b> <?php echo $this->data['Client']['url']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Nome: </b> <?php echo $this->data['Client']['first_name']; ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Sobrenome: </b> <?php echo $this->data['Client']['last_name']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">CPF: </b> <?php echo $this->data['Client']['cpf']; ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Data de nascimento: </b> <?php echo $this->Date->formatDate($this->data['Client']['birth'], 'br'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">CRM: </b> <?php echo $this->data['Client']['crm']; ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">RQE: </b> <?php echo $this->data['Client']['rqe']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 m-b">
                                    <b class="">Especialidades: </b><br><?php echo $this->data['Client']['specialties']; ?>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <h2 class="m-b">Informações de contato</h2>

                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <b class="">Telefone 1: </b> <?php echo $this->data['Client']['phone']; ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <b class="">Telefone 2: </b> <?php echo $this->data['Client']['phone_2']; ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <b class="">Telefone 3: </b> <?php echo $this->data['Client']['phone_3']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <b class="">E-mail 1: </b> <?php echo $this->data['Client']['email']; ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <b class="">E-mail 2: </b> <?php echo $this->data['Client']['email_2']; ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <b class="">E-mail 3: </b> <?php echo $this->data['Client']['email_3']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 m-b">
                                    <b class="">Descrição: </b><br><?php echo $this->data['Client']['description']; ?>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <h2 class="m-b">Endereço do consultório</h2>

                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">CEP nº: </b> <?php echo $this->data['Client']['cep']; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Endereço completo: </b> <?php echo $this->data['Client']['address']; ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Estado: </b> <?php echo $this->data['Client']['state']; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Cidade: </b> <?php echo $this->data['Client']['city']; ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Bairro: </b> <?php echo $this->data['Client']['neighborhood']; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Numero: </b> <?php echo $this->data['Client']['number']; ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <b class="">Complemento: </b> <?php echo $this->data['Client']['complement']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Resumo</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b">
                                <div class="col-xs-12 col-md-12">
                                    <h2 class="m-b">Foto PNG</h2>
                                    <?php if(!empty($this->data['Client']['photo'])){ ?>
                                        <a href="<?php echo $this->webroot . 'files/photos/' . $this->data['Client']['photo']; ?>" class="fancybox">
                                            <img src="<?php echo $this->webroot . 'files/photos/' . $this->data['Client']['photo']; ?>">
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <h2 class="m-b">Banner Mobile</h2>
                                    <?php if(!empty($this->data['Client']['banner_mobile'])){ ?>
                                        <a href="<?php echo $this->webroot . 'files/banners/' . $this->data['Client']['banner_mobile']; ?>" class="fancybox">
                                            <img src="<?php echo $this->webroot . 'files/banners/' . $this->data['Client']['banner_mobile']; ?>">
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>