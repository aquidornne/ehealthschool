<?php require('init.php'); ?>
<?php
global $page_current;

$page_current = 'about';
?>

<?php include_once('inc/header.php'); ?>
    <main>
        <section id="" class="internal-pages-header">
            <div class="container pdt-10 pdb-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="no-margin style-02">A Empresa</h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="">
            <div class="container pdt-100 pdb-80 wow fadeInUp" data-wow-duration="1s">
                <div class="row">
                    <div class="col-xs-12 col-md-4 pdb-20">
                        <img src="<?php echo _PROJECT_; ?>img/ehealthschool-estudio.jpg" class="img-responsive" title="eHealthSchool Estúdio" alt="eHealthSchool Estúdio">
                    </div>
                    <div class="col-xs-12 col-md-8 pdb-20">
                        <p class="text-justify">
                            A eHealthSchool é um portal dedicado à atualização do conhecimento médico. Aliando os mais modernos conceitos de didática, associados a soluções inovadoras de tecnologia a eHealthSchool oferece cursos de atualização em medicina que podem ser realizados a distância, com praticidade e qualidade. Profissionais de saúde usualmente trabalham muito e tem pouco tempo para atualização e especialização, sendo a educação à distância (EAD) a solução adequada.
                        </p>
                        <h2>Visão</h2>
                        <p>Facilitar a educação e atualização médica</p>
                        <h2>Missão</h2>
                        <p>Oferecer educação e atualização em saúde com qualidade e praticidade.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include_once('inc/footer.php'); ?>