<?php require('init.php'); ?>
<?php
global $page_current;

$page_current = 'contact';
?>

<?php include_once('inc/header.php'); ?>
    <main>
        <section id="" class="internal-pages-header">
            <div class="container pdt-10 pdb-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="no-margin style-02" >
                            Fale Conosco
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="newsletter" class="">
            <div class="container pdt-100 pdb-50 wow fadeInUp" data-wow-duration="1s">
                <div class="row">
                    <div class="col-lg-12 pdb-50">
                        <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                            <span class="vc_sep_holder vc_sep_holder_l"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                            <h1 class="style-01">Envie-nos uma mensagem através do formulário abaixo</h1>
                            <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                        </div>

                        <form id="form_contact" method="POST" action="<?php echo _PROJECT_; ?>email_forms.php">
                            <div class="form_contact">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nome *</label>
                                            <input type="text" name="name" class="form-control" placeholder="Nome" validation="1">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">E-mail *</label>
                                            <input type="text" name="email_form" class="form-control" placeholder="E-mail" validation="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Telefone (WhatsApp) *</label>
                                            <input type="text" name="phone" class="form-control" placeholder="Telefone (WhatsApp)" validation="1">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Assunto</label>
                                            <input type="text" name="subject" class="form-control" placeholder="Assunto" validation="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">Mensagem *</label>
                                            <textarea name="message" class="form-control" placeholder="Mensagem" validation="1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="form_type" value="newsletter">
                                <div class="text-center">
                                    <button type="button" class="btn btn-site-02 btn_contact">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include_once('inc/footer.php'); ?>