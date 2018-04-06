<?php require('init.php'); ?>
<?php
global $page_current;

$page_current = 'home';

$banners_web = $system->serviceFindBanners(array(
        'is_mobile' => 0
    )
);

$banners_mobile = $system->serviceFindBanners(array(
        'is_mobile' => 1
    )
);

$coursers = $system->serviceFindAllCourse();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);

    /*
     * Salvar Newsletter.
     */
    if ($_POST['form_type'] == 'newsletter') {
        $data = array(
            'Newsletter' => array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            )
        );

        if ($system->serviceSaveNewsletters($data)) {
            Tools::redirect(_PROJECT_ . 'site' . '?success=1');
        } else {
            Tools::redirect(_PROJECT_ . 'site' . '?success=0');
        }
    }
}
?>

<?php include_once('inc/header.php'); ?>
    <main>
        <section>
            <!-- --------------------------------------------------------------------------------------------------- -->
            <!-- Banners Web -->
            <?php if(isset($banners_web->data) AND !empty($banners_web->data)){ ?>
                <div class="slider-01">
                    <img class="headerImg" src="<?php echo _SYSTEM_FILES_; ?>banners/<?php echo $banners_web->data[0]->Banner->file; ?>" data-slideshow="
                    <?php foreach($banners_web->data as $key => $row){ ?>
                         <?php if($key != 0){ ?>
                             <?php echo _SYSTEM_FILES_; ?>banners/<?php echo $row->Banner->file; ?>
                             <?php echo ((isset($banners_web->data[($key + 1)]) AND !empty($banners_web->data[($key + 1)])) ? '|' : ''); ?>
                         <?php } ?>
                    <?php } ?>
                    ">
                </div>
            <?php } ?>
            <!-- --------------------------------------------------------------------------------------------------- -->
            <!-- Banners Mobile -->
            <?php if(isset($banners_mobile->data) AND !empty($banners_mobile->data)){ ?>
                <div class="slider-02">
                    <img class="headerImg" src="<?php echo _SYSTEM_FILES_; ?>banners/<?php echo $banners_mobile->data[0]->Banner->file; ?>" data-slideshow="
                    <?php foreach($banners_mobile->data as $key => $row){ ?>
                         <?php if($key != 0){ ?>
                             <?php echo _SYSTEM_FILES_; ?>banners/<?php echo $row->Banner->file; ?>
                             <?php echo ((isset($banners_mobile->data[($key + 1)]) AND !empty($banners_mobile->data[($key + 1)])) ? '|' : ''); ?>
                         <?php } ?>
                    <?php } ?>
                    ">
                </div>
            <?php } ?>
            <!-- --------------------------------------------------------------------------------------------------- -->
        </section>
        <section id="" class="">
            <div class="container pdt-100 pdb-100 wow fadeInUp" data-wow-duration="1s">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                            <span class="vc_sep_holder vc_sep_holder_l"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                            <h1 class="style-01">Seja Bem-Vindo</h1>
                            <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                        </div>

                        <h2 class="no-margin mgb-50 text-center">eHealthSchool, sua atualização a 1 click!</h2>
                        <p class="text-center">Nós acreditamos que para melhorar a saúde da população os profissionais da saúde precisam estar em constante atualização.</p>
                        <p class="text-center">Utilizando técnicas tradicionais de didática aliadas ao que existe de mais moderno em e-learning, a eHealthSchool oferece cursos de atualização que podem ser assistidos no conforto da sua casa, no seu ritmo, na sua disponibilidade de tempo.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="theme-type-style-01">
            <div class="container pdt-100 pdb-80 wow fadeInUp" data-wow-duration="1s">
                <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                    <h2 class="style-03 noPaddingLeft">Nossos Cursos</h2>
                    <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                </div>
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
                <div class="text-center">
                    <a href="<?php echo _PROJECT_; ?>nossos_cursos" class="btn btn-site-01">Ver lista completa de cursos</a>
                </div>
            </div>
        </section>
        <section id="newsletter" class="">
            <div class="container pdt-100 pdb-50 wow fadeInUp" data-wow-duration="1s">
                <div class="row">
                    <div class="col-lg-12 pdb-50">
                        <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                            <span class="vc_sep_holder vc_sep_holder_l"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                            <h2 class="style-03">Cadastre-se para receber Nossas Novidades</h2>
                            <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                        </div>
                        <form id="form_newsletter" method="POST">
                            <div class="form_newsletter" class="wow fadeInUp" data-wow-duration="2s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">Nome *</label>
                                            <input type="text" name="name" class="form-control" placeholder="Nome" validation="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">E-mail *</label>
                                            <input type="text" name="email" class="form-control" placeholder="E-mail" validation="1">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Telefone (WhatsApp)</label>
                                            <input type="text" name="phone" class="form-control mask_cellular" placeholder="Telefone" validation="0">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="form_type" value="newsletter">
                                <div class="text-center">
                                    <button type="button" class="btn btn-site-02 btn_newsletter">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="">
            <div class="theme-type-style-02">
                <div class="container pdt-100 pdb-50 wow fadeInUp" data-wow-duration="1s">
                    <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                        <h2 class="noPaddingLeft style-04">BLOG / NOTÍCIAS</h2>
                        <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#fff;" class="vc_sep_line"></span></span>
                    </div>
                    <div class="news-home">
                        <div class="row">
                            <?php if(!empty($blogData)){ ?>
                                <?php foreach($blogData as $key => $row){ ?>
                                    <div class="col-xs-12 col-md-4 pdb-50">
                                        <?php if(isset($row['image']) AND !empty($row['image'])){ ?>
                                            <div class="pdb-10">
                                                <div class="photo-block"
                                                     style="background-image: url('<?php echo $row['image']; ?>');">
                                                    <a href="<?php echo $row['link']; ?>"></a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <h3 class="no-margin">
                                            <a href="<?php echo $row['link']; ?>" class="style-02"><?php echo $row['title']; ?></a>
                                        </h3>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        $('.btn_newsletter').on('click', function (e){
            e.preventDefault();

            var submit = true;
            var data = $('.form_newsletter input, .form_newsletter textarea, .form_newsletter select').serialize();

            $('.form_newsletter input, .form_newsletter textarea, .form_newsletter select').each(function (){
                if (parseInt($(this).attr('validation')) == 1 && $(this).val() == "") {
                    $(this).parent().addClass('error');
                    submit = false;
                } else {
                    $(this).parent().removeClass('error');
                }
            });

            if (submit == true) {
                $('#form_newsletter').submit();
            } else {
                toastr.error('Preencha os campos obrigatórios');
            }
        });

        $(document).on('ready', function() {
            $(".regular").slick({
                dots: true,
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });
        });
    </script>

<?php include_once('inc/footer.php'); ?>