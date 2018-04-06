    <section id="" class="">
        <div class="theme-type-style-03">
            <div class="container pdt-50 pdb-30 wow fadeInUp" data-wow-duration="1s">
                <div class="row">
                    <div class="col-xs-12 col-md-3 pdb-20 white">
                        <h4 class="style-01 no-margin mgb-20" title="">CENTRAL DE ATENDIMENTO</h4>
                        <p><i class="fa fa-user" aria-hidden="true"></i> (11) 4191-3619</p>
                    </div>
                    <div class="col-xs-12 col-md-3 pdb-20 white">
                        <h4 class="style-01 no-margin mgb-20" title="">FALE CONOSCO</h4>
                        <a href="<?php echo _PROJECT_; ?>fale_conosco" class="style-02"><i class="fa fa-comments" aria-hidden="true"></i> Queremos ouvir suas críticas e sugestões</a>
                    </div>
                    <div class="col-xs-12 col-md-3 pdb-20 white">
                        <h4 class="style-01 no-margin mgb-20" title="">REDES SOCIAIS</h4>
                        <a target="_blank" href="https://www.facebook.com/ehealthschool/" class="social-02"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a target="_blank" href="https://www.instagram.com/ehealthschool/" class="social-02"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UCDPgR__q_nZ0cEqFPRW0W0Q" class="social-02"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-xs-12 col-md-3 pdb-20 white">
                        <h4 class="style-01 no-margin mgb-20" title="">ÚLTIMAS NOTÍCIAS</h4>
                        <?php if(!empty($blogData)){ ?>
                            <?php foreach($blogData as $key => $row){ ?>
                                <a href="<?php echo $row['link']; ?>" class="style-02"><?php echo $row['title']; ?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <hr>
                        <nav id="">
                            <ul class="list-footer">
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
    </section>
    <section id="" class="">
        <div class="container pdt-20 pdb-10">
            <div class="row">
                <div class="col-xs-12 col-md-6 text-left-responsive pdb-10">
                    @2018 eHealth School | CNPJ: 24.624.299/0001-13
                </div>
                <div class="col-xs-12 col-md-6 text-right-responsive pdb-10">
                    Desenvolvido e administrado por <a target="_blank" href="http://visanacomunicacao.com.br/" class="">Visana Comunicação</a>
                </div>
            </div>
        </div>
    </section>
</div>

<a href="#" id="go-top" class="home-btn"></a>

</body>
</html>

<script>
	<?php if(isset($_GET['success']) AND $_GET['success'] != NULL){ ?>
		<?php if($_GET['success'] == 1){ ?>
			$(document).ready(function(){ toastr.success('Contato enviado com sucesso!'); });
		<?php }else{ ?>
			$(document).ready(function(){ toastr.error('Ocorreu algum erro, tente outra forma de contato.'); });
		<?php } ?>
	<?php } ?>

    $('.btn_contact').on('click', function (e){
        e.preventDefault();

        var submit = true;
        var data = $('.form_contact input, .form_contact textarea, .form_contact select').serialize();

        $('.form_contact input, .form_contact textarea, .form_contact select').each(function (){
            if (parseInt($(this).attr('validation')) == 1 && $(this).val() == "") {
                $(this).parent().addClass('error');
                submit = false;
            } else {
                $(this).parent().removeClass('error');
            }
        });

        if (submit == true) {
			$('#form_contact').submit();
        } else {
            toastr.error('Preencha os campos obrigatórios');
        }
    });

    wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100,
            callback: function (box) {
                console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        }
    );
    wow.init();
</script>