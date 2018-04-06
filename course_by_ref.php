<?php require('init.php'); ?>
<?php
global $page_current;

$page_current = 'courses_2';

if(!isset($_GET['url']) OR empty($_GET['url'])){
    Tools::redirect(_PROJECT_ . 'error');
}

$courser = $system->serviceFindCourseByUrl(array('url' => $_GET['url']));
?>

<?php include_once('inc/header.php'); ?>
    <main>
        <section id="" class="internal-pages-header">
            <div class="container pdt-10 pdb-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="no-margin style-02">Curso: <?php echo $courser->data->Course->name; ?></h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="">
            <div class="container pdt-100 pdb-80 wow fadeInUp" data-wow-duration="1s">
                <div class="row">
                    <?php if(isset($courser->data->Course->video) AND !empty($courser->data->Course->video)){ ?>
                        <div class="col-xs-12 col-md-6 pdb-20">
                            <iframe width="100%" height="281" src="https://www.youtube.com/embed/<?php echo $courser->data->Course->video; ?>?feature=oembed" frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php } ?>
                    <div class="col-xs-12 <?php echo ((isset($courser->data->Course->video) AND !empty($courser->data->Course->video)) ? 'col-md-6' : 'col-md-12'); ?> pdb-20">
                        <div class="table-responsive pdb-20">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Módulos</td>
                                    <td><?php echo $courser->data->Course->modules; ?></td>
                                </tr>
                                <tr>
                                    <td>Aulas</td>
                                    <td><?php echo $courser->data->Course->classrooms; ?></td>
                                </tr>
                                <tr>
                                    <td>Objetos de Aprendizagem</td>
                                    <td><?php echo $courser->data->Course->learning_objects; ?></td>
                                </tr>
                                <tr>
                                    <td>Carga horária</td>
                                    <td><?php echo $courser->data->Course->workload; ?></td>
                                </tr>
                                <tr>
                                    <td>Nível</td>
                                    <td><?php echo $courser->data->Course->level; ?></td>
                                </tr>
                                <tr>
                                    <td>Certificado</td>
                                    <td>
                                        <?php if($courser->data->Course->certificate){ ?>
                                            <b>Sim</b>
                                        <?php }else { ?>
                                            Não
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="pdb-20">
                            <span class="price"><?php echo Tools::convertReal($courser->data->Course->value, 'R$ '); ?></span>
                        </div>

                        <div class="">
                            <a href="<?php echo _PROJECT_; ?>matricula/<?php echo $courser->data->Course->id; ?>/<?php echo $courser->data->Course->url; ?>" class="btn btn-site-04">Faça sua matrícula</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="">
            <div class="container pdb-50 wow fadeInUp" data-wow-duration="1s">
                <div class="row">
                    <div class="col-xs-12 col-md-6 pdb-50">
                        <div class="bg-grey-01">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#tab-1">Detalhes do Curso</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-2">Grade Curricular</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-3">Mais Informações</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <?php echo $courser->data->Course->course_details; ?>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <?php echo $courser->data->Course->curricular_grade; ?>
                                        </div>
                                        <div id="tab-3" class="tab-pane">
                                            <?php echo $courser->data->Course->more_information; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="pdb-20">
                            <h2 class="no-margin text-center mgb-10">Responsáveis pelo Curso</h2>
                            <div class="detail-teachers"></div>
                        </div>
                        <div class="bg-grey-01">
                            <div class="accordions">
                                <?php if(isset($courser->data->Teacher) AND !empty($courser->data->Teacher)){ ?>
                                    <?php foreach($courser->data->Teacher as $key => $row){ ?>
                                        <div class="accordion">
                                            <h3 class="no-margin mgb-10">
                                                <span class="accordion-icon"></span>
                                                <a href="#" class="accordion-link"><?php echo $row->Teacher->name; ?></a>
                                            </h3>
                                            <div class="accordion-content"><?php echo $row->Teacher->description; ?></div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include_once('inc/footer.php'); ?>