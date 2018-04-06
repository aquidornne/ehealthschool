<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, user-scalable=no">

    <meta name="keywords" content="<?php echo $config['keywords']; ?>">
    <meta name="rights" content="<?php echo $config['rights']; ?>">
    <meta name="description" content="<?php echo $config['description']; ?>">

	<!--<link rel="shortcut icon" type="image/x-icon" href="<?php echo _PROJECT_; ?>img/favicon.png">-->

    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/bootstrap.css">

    <script src="<?php echo _PROJECT_; ?>js/jquery-2.2.0.min.js"></script>
    <script src="<?php echo _PROJECT_; ?>js/bootstrap.js"></script>
    <script src="<?php echo _PROJECT_; ?>js/modernizr.js"></script>

    <!-- Toasty -->
    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/toastr/toastr.min.css">
    <script src="<?php echo _PROJECT_; ?>js/toastr/toastr.js"></script>

    <!-- Add mousewheel plugin (this is optional) -->
    <script src="<?php echo _PROJECT_; ?>js/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/fancybox/jquery.fancybox.css" media="screen">
    <script src="<?php echo _PROJECT_; ?>js/fancybox/jquery.fancybox.js"></script>

    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/fancybox/helpers/jquery.fancybox-buttons.css">
    <script src="<?php echo _PROJECT_; ?>js/fancybox/helpers/jquery.fancybox-buttons.js"></script>

    <!-- Add Thumbnail helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/fancybox/helpers/jquery.fancybox-thumbs.css">
    <script src="<?php echo _PROJECT_; ?>js/fancybox/helpers/jquery.fancybox-thumbs.js"></script>

    <!-- Add Media helper (this is optional) -->
    <script src="<?php echo _PROJECT_; ?>js/fancybox/helpers/jquery.fancybox-media.js"></script>

    <script src="<?php echo _PROJECT_; ?>js/fancybox/helpers/jquery.fancybox-thumbs.js"></script>

    <script src="<?php echo _PROJECT_; ?>js/jquery.maskedinput.js"></script>

	<script src="<?php echo _PROJECT_; ?>js/jquery.easing.1.3.js"></script>
	<script src="<?php echo _PROJECT_; ?>js/jquery.fitvids.js"></script>

	<script src="<?php echo _PROJECT_; ?>js/bxslider/jquery.bxslider.js"></script>
	<script src="<?php echo _PROJECT_; ?>js/bxslider/jquery.bxslider.min.js"></script>

	<script src="<?php echo _PROJECT_; ?>js/wow.min.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/composer.css">

	<link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/bxslider/jquery.bxslider.css">

	<link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/animate.css">

    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>js/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>js/slick/slick-theme.css">
    <script src="<?php echo _PROJECT_; ?>js/slick/slick.js"></script>

    <!-- Jquery Slideshow Plugin -->
    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>js/slideshow-plugin/assets/css/demopage.css">
    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>js/slideshow-plugin/assets/jQuery-slideshow-plugin/plugin.css">

    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/font-awesome.min.css">

    <script src="<?php echo _PROJECT_; ?>js/slideshow-plugin/assets/js/jquery.hammer-full.min.js"></script>
    <script src="<?php echo _PROJECT_; ?>js/slideshow-plugin/assets/jQuery-slideshow-plugin/plugin.js"> </script>
    <script src="<?php echo _PROJECT_; ?>js/slideshow-plugin/assets/js/demo.js"></script>

    <script src="<?php echo _PROJECT_; ?>js/application.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo _PROJECT_; ?>css/custom-bootstrap.css">

	<script>
		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": false,
		  "positionClass": "toast-bottom-left",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
	</script>

    <script>
        $(function (){
            app.webroot = '<?php echo _PROJECT_; ?>';
        });
    </script>

    <?php echo ((isset($meta_increment)) ? $meta_increment : ''); ?>
</head>
<body>

<div id="loadingPage"><img class="loading" src="<?php echo _PROJECT_; ?>img/loading.svg"></div>

<div id="top-mobile">
    <div class="login-responsive mobile-show">
        <div class="container pdt-10 pdb-10">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="<?php echo _PROJECT_; ?>login" class="white">Login <i class="fa fa-sign-in" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-show">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 logo-mobile">
                    <a class="" href="<?php echo _PROJECT_; ?>site"><img class="img-responsive" src="<?php echo _PROJECT_; ?>img/logo.png" title="eHealthSchool Logotipo" alt="eHealthSchool Logotipo"></a>
                </div>
            </div>
        </div>
    </div>
</div>

<header>
    <div class="top-02">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="">
                        <span class="contacts-top"><i class="fa fa-phone" aria-hidden="true"></i> (11) 4191-3619</span>
                        <span class="contacts-top"><i class="fa fa-envelope" aria-hidden="true"></i> contato@ehealthschool.com.br</span>
                        <span class="contacts-top">
                            <a target="_blank" href="https://www.facebook.com/ehealthschool/" class="social-01"><i class="fa fa-facebook fa-1x" aria-hidden="true"></i></a>
                            <a target="_blank" href="https://www.instagram.com/ehealthschool/" class="social-01"><i class="fa fa-instagram fa-1x" aria-hidden="true"></i></a>
                            <a target="_blank" href="https://www.youtube.com/channel/UCDPgR__q_nZ0cEqFPRW0W0Q" class="social-01"><i class="fa fa-youtube fa-1x" aria-hidden="true"></i></a>
                    </span>
                    </div>
                </div>
                <div class="col-xs-4 col-md-4 social-icons-header mobile-hide text-right">
                    <a href="<?php echo _PROJECT_; ?>login" class="style-01">Login <i class="fa fa-sign-in" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="top-01">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-md-4 logo">
                    <a class="" href="<?php echo _PROJECT_; ?>site"><img class="img-responsive" src="<?php echo _PROJECT_; ?>img/logo.png" title="eHealthSchool Logotipo" alt="eHealthSchool Logotipo"></a>
                </div>
                <div class="col-xs-6 col-md-1 btn-responsive-menu-col">
                    <a id="responsive-menu" href="#" class="btn-responsive-menu type-02"></a>
                </div>
                <div class="col-xs-12 col-md-8">
                    <nav id="main-menu">
                        <ul class="nav-menu active">
                            <li class="<?php echo (($page_current == 'home') ? 'active' : ''); ?>">
                                <a href="<?php echo _PROJECT_; ?>site" menu="" class="no-default">
                                    <div class="div-border">Home</div>
                                </a>
                            </li>
                            <li class="<?php echo (($page_current == 'courses_1') ? 'active' : ''); ?>">
                                <a href="<?php echo _PROJECT_; ?>curso_para_professores_de_medicina" menu="" class="no-default">
                                    <div class="div-border">Curso para professores</div>
                                </a>
                            </li>
                            <li class="<?php echo (($page_current == 'about') ? 'active' : ''); ?>">
                                <a href="<?php echo _PROJECT_; ?>a_empresa" menu="" class="no-default">
                                    <div class="div-border">A Empresa</div>
                                </a>
                            </li>
                            <li class="<?php echo (($page_current == 'courses_2') ? 'active' : ''); ?>">
                                <a href="<?php echo _PROJECT_; ?>nossos_cursos" menu="" class="no-default">
                                    <div class="div-border">Cursos</div>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $config['blog']; ?>" class="no-default">
                                    <div class="div-border">Blog</div>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-general">