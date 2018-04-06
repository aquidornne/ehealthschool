<?php require('init.php'); ?>
<?php
global $page_current;

$page_current = 'courses_2';

$coursers = $system->serviceFindAllCourse(array(
        'page' => ((isset($_GET['page']) AND !empty($_GET['page'])) ? $_GET['page'] : 1),
        'limit' => ((isset($_GET['limit']) AND !empty($_GET['limit'])) ? $_GET['limit'] : 28)
    )
);
?>

<?php include_once('inc/header.php'); ?>
    <main>
        <section id="" class="internal-pages-header">
            <div class="container pdt-10 pdb-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="no-margin style-02" >
                            Nossos Cursos
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container pdt-100 pdb-100 wow fadeInUp" data-wow-duration="1s">
                <div class="row pdb-50">
                    <?php if(isset($coursers->data) AND !empty($coursers->data)){ ?>
                        <?php foreach($coursers->data as $key => $row){ ?>
                            <div class="col-xs-12 col-md-4 pdb-20">
                                <div class="pdb-20">
                                    <img src="<?php echo _PROJECT_; ?>system/files/courses/<?php echo $row->Course->cover; ?>" class="img-responsive" title="" alt="">
                                </div>
                                <h4 class="no-margin mgb-20"><?php echo $row->Course->name; ?></h4>
                                <p class="no-margin mgb-20">
                                    <?php echo nl2br(substr($row->Course->resume, 0, 100)) . '...'; ?>
                                </p>
                                <div class="price pdb-20">
                                    <i class="fa fa-money"></i> <b><?php echo Tools::convertReal($row->Course->value, 'R$ '); ?></b>
                                </div>
                                <a href="<?php echo _PROJECT_; ?>curso/<?php echo $row->Course->id; ?>/<?php echo $row->Course->url; ?>" class="btn btn-site-03">Saiba Mais</a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="pagination pull-right">
                            <?php for($i = 1; $i <= $coursers->numbers; ++$i) { ?>
                                <li class="<?php echo ((isset($_GET['page']) AND $_GET['page'] == $i) ? 'active' : ''); ?>"><a href="<?php echo _PROJECT_; ?>course_2.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include_once('inc/footer.php'); ?>