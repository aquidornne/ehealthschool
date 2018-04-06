<div class="row border-bottom white-bg dashboard-header">
    <h2 class="noMarginTop">Cadastrar Banner</h2>
    <?php //echo $this->element('breadcrumb'); ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <?php echo $this->Form->create('Banner', array('id' => 'form_add', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal m-t-md')); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Banners</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" style="">
                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label">Mobile</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <!-- radio i-checks -->
                                    <div class="radio"><label> <input type="radio" name="data[Banner][is_mobile]" class="is_mobile" checked="" value="0"> <i></i> Não </label></div>
                                    <div class="radio"><label> <input type="radio" name="data[Banner][is_mobile]" class="is_mobile" value="1"> <i></i> Sim </label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <label class="control-label">Comentários</label>
                                    <?php echo $this->Form->textarea('comments', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'Comentários')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 m-b">
                                    <div class="">
                                        <label class="control-label">Banners</label>
                                        <input id="banners" type="file" name="banners[]" multiple>
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

        if (!$('#banners').val()) {
            application.inlineFieldAlert('add', 'input', $('#banners'), 'Insira um ou mais arquivos.', 'warning', false);
            error.push(1);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#banners'));
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