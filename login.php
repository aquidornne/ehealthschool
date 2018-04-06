<?php require('init.php'); ?>
<?php
global $page_current;

$page_current = 'registration';

$user = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);

    $data = array(
        'User' => array(
            'email' => $email,
            'password' => $password
        )
    );
    $user = $system->serviceLogin($data);

    if ($user->success) {
        $_SESSION['auth'] = $user;

        $eadbox = new EADBoxIntegration(array(
            'trust' => FALSE
        ));

        $eadbox_auth = $eadbox->login(array(
            'email' => $email,
            'password' => $password
        ));

        Tools::redirect($eadbox_auth->login_url . '?' . $eadbox_auth->token_authentication_key . '=' . $eadbox_auth->authentication_token);
    } else {
        $is_login = FALSE;
    }
}
?>

<?php include_once('inc/header.php'); ?>
    <main>
        <section id="" class="internal-pages-header">
            <div class="container pdt-10 pdb-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="no-margin style-02">Matrícula</h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="">
            <div class="container pdt-100 pdb-50 wow fadeInUp" data-wow-duration="1s">
                <div class="row">
                    <div class="col-xs-12 col-md-8 pdb-50">
                        <!-- Tela de Login. -->
                        <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                            <h2 class="style-03 noPaddingLeft">Login</h2>
                            <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                        </div>
                        <form id="form_login_02" method="post">
                            <?php if(isset($is_login) AND !$is_login){ ?>
                                <div class="">
                                    <div class="alert alert-warning">
                                        Acesso inválido.
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="bg-grey-02">
                                <div class="row">
                                    <div class="col-lg-12 m-b">
                                        <div class="form-group">
                                            <label class="control-label">E-mail</label>
                                            <input type="text" name="email" class="form-control" placeholder="E-mail" validation="1" value="<?php echo ((isset($user->data->User->email) AND !empty($user->data->User->email)) ? $user->data->User->email : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 m-b">
                                        <div class="form-group">
                                            <label class="control-label">Senha</label>
                                            <input type="password" name="password" class="form-control" placeholder="Senha" validation="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">
                                        <input type="hidden" name="url" value="<?php echo $_GET['url']; ?>">
                                        <input type="hidden" name="step" value="1">
                                        <button type="submit" class="btn btn-site-02 btn_login_02">Avançar</button>

                                        <div class="text-center pdt-10">
                                            <a href="<?php echo _SYSTEM_; ?>Users/password_recover_1">Esqueci minha senha</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 col-md-4 pdb-50">
                        <div class="">
                            <p>Você será direcionado direto para nossa plataforma de ensino.</p>
                            <hr>
                            <img src="<?php echo _PROJECT_; ?>img/eadbox-logo.png" class="img-responsive" style="max-height: 50px;" alt="EadBox" title="EadBox">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include_once('inc/footer.php'); ?>

<script>
    $('.btn_login_02').on('click', function (e){
        e.preventDefault();

        var submit = true;
        var data = $('#form_login_02 input, #form_login_02 textarea, #form_login_02 select').serialize();

        $('#form_login_02 input, #form_login_02 textarea, #form_login_02 select').each(function (){
            if (parseInt($(this).attr('validation')) == 1 && $(this).val() == "") {
                $(this).parent().addClass('error');
                submit = false;
            } else {
                $(this).parent().removeClass('error');
            }
        });

        if (submit == true) {
            $('#form_login_02').submit();
        } else {
            toastr.error('Preencha os campos obrigatórios');
        }
    });
</script>
