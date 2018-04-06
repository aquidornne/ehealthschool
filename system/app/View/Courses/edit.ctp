<div class="row border-bottom white-bg dashboard-header">
    <h2 class="noMarginTop">Editar Curso</h2>
    <?php //echo $this->element('breadcrumb'); ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <?php echo $this->Form->create('Course', array('id' => 'form_edit', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal m-t-md')); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Curso</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" style="">
                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label">Referência EADBox</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">ID do Curso</label>
                                    <?php echo $this->Form->input('eadbox_id', array('div' => FALSE, 'label' => FALSE, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'ID do Curso')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label">Dados do Curso</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <label class="control-label">URL</label>
                                    <?php echo $this->Form->input('url', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'URL')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <label class="control-label">Nome</label>
                                    <?php echo $this->Form->input('name', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'Nome')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b">
                                    <label class="control-label">Professores Responsáveis</label>
                                    <?php echo $this->Form->input('teachers', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control chosen-select', 'options' => $teachers, 'selected' => explode(',', $this->data['Course']['teachers']), 'empty' => TRUE, 'multiple' => 'multiple', 'data-placeholder' => 'Selecione os Professores')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b">
                                    <label class="control-label">Resumo</label>
                                    <?php echo $this->Form->textarea('resume', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control jqte', 'placeholder' => 'Resumo')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b">
                                    <label class="control-label">Detalhes do Curso</label>
                                    <?php echo $this->Form->textarea('course_details', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control jqte', 'placeholder' => 'Detalhes do Curso')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b">
                                    <label class="control-label">Grade Curricular</label>
                                    <?php echo $this->Form->textarea('curricular_grade', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control jqte', 'placeholder' => 'Grade Curricular')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b">
                                    <label class="control-label">Mais Informações</label>
                                    <?php echo $this->Form->textarea('more_information', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control jqte', 'placeholder' => 'Mais Informações')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Módulos</label>
                                    <?php echo $this->Form->input('modules', array('div' => FALSE, 'label' => FALSE, 'min' => 1, 'class' => 'form-control', 'placeholder' => 'Módulos')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Aulas</label>
                                    <?php echo $this->Form->input('classrooms', array('div' => FALSE, 'label' => FALSE, 'min' => 1, 'class' => 'form-control', 'placeholder' => 'Aulas')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Objetos de Aprendizagem</label>
                                    <?php echo $this->Form->input('learning_objects', array('div' => FALSE, 'label' => FALSE, 'min' => 1, 'class' => 'form-control', 'placeholder' => 'Objetos de Aprendizagem')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Carga Horária</label>
                                    <?php echo $this->Form->input('workload', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control mask_time', 'placeholder' => 'Carga Horária')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Nível</label>
                                    <?php echo $this->Form->input('level', array('div' => FALSE, 'label' => FALSE, 'class' => 'form-control', 'placeholder' => 'Nível')); ?>
                                </div>
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Certificado</label>
                                    <!-- radio i-checks -->
                                    <div class="radio"><label> <input type="radio" name="data[Course][certificate]" class="certificate" checked="" value="0"> <i></i> Não </label></div>
                                    <div class="radio"><label> <input type="radio" name="data[Course][certificate]" class="certificate" value="1"> <i></i> Sim </label></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-b">
                                    <div class="m-b">
                                        <label class="control-label">Capa</label>
                                        <input id="cover" type="file" name="data[Course][cover]">
                                    </div>
                                    <?php if(!empty($this->data['Course']['cover'])){ ?>
                                        <a href="<?php echo $this->webroot . 'files/courses/' . $this->data['Course']['cover']; ?>" class="fancybox">
                                            <img src="<?php echo $this->webroot . 'files/courses/' . $this->data['Course']['cover']; ?>">
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="col-xs-12 col-md-6 m-b">
                                    <div class="">
                                        <label class="control-label">Informe o ID do Video no Youtube</label>
                                        <?php echo $this->Form->input('video', array('div' => FALSE, 'label' => FALSE, 'min' => 1, 'class' => 'form-control', 'placeholder' => 'ID do Video')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group noMarginBottom">
                        <label class="col-sm-2 control-label">Dados de Venda</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-xs-12 col-md-4 m-b">
                                    <label class="control-label">Value</label>
                                    <?php echo $this->Form->input('value', array('div' => FALSE, 'label' => FALSE, 'type'  => 'text', 'class' => 'form-control mask_money', 'placeholder' => 'Value')); ?>
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
                    <?php echo $this->Form->hidden('Course.id', array('value' => $id)); ?>
                    <?php echo $this->Form->hidden('Course.cover_old', array('value' => $this->data['Course']['cover'])); ?>

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

        if (!$('#CourseEadboxId').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseEadboxId'), 'Informe o ID.', 'warning', false);
            error.push(1);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseEadboxId'));
        }

        if (!$('#CourseUrl').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseUrl'), 'Informe a url.', 'warning', false);
            error.push(2);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseUrl'));
        }

        if (!$('#CourseName').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseName'), 'Informe o nome do curso.', 'warning', false);
            error.push(3);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseName'));
        }

        if (!$('#CourseTeachers').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseTeachers'), 'Informe os professores.', 'warning', false);
            error.push(4);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseTeachers'));
        }

        if (!$('#CourseResume').val()) {
            application.inlineFieldAlert('add', 'input-prepend', $('#CourseResume'), 'Escreva um resumo do curso.', 'warning', false);
            error.push(5);
        } else {
            application.inlineFieldAlert('clean', 'input-prepend', $('#CourseResume'));
        }

        if (!$('#CourseModules').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseModules'), 'Informe a quantidade de módulos.', 'warning', false);
            error.push(6);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseModules'));
        }

        if (!$('#CourseClassrooms').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseClassrooms'), 'Informe a quantidade de aulas.', 'warning', false);
            error.push(7);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseClassrooms'));
        }

        if (!$('#CourseLearningObjects').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseLearningObjects'), 'Informe a quantidade de objetos de aprendizagem.', 'warning', false);
            error.push(8);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseLearningObjects'));
        }

        if (!$('#CourseWorkload').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseWorkload'), 'Informe a carga horária.', 'warning', false);
            error.push(9);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseWorkload'));
        }

        if (!$('#CourseLevel').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseLevel'), 'Informe o nível.', 'warning', false);
            error.push(10);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseLevel'));
        }

        if (!$('#CourseValue').val()) {
            application.inlineFieldAlert('add', 'input', $('#CourseValue'), 'Informe o valor.', 'warning', false);
            error.push(11);
        } else {
            application.inlineFieldAlert('clean', 'input', $('#CourseValue'));
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