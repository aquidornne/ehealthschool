<?php require('init.php'); ?>
<?php
global $page_current;

$page_current = 'registration';

if (!isset($_GET['url']) OR empty($_GET['url'])) {
    Tools::redirect(_PROJECT_ . 'error');
}

$courser = $system->serviceFindCourseByUrl(array('url' => $_GET['url']));

$user = array();

$step = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);

    /*
     * Verifico se existe usuário relacionado ao CPF informado. Caso exista, envio o usuário para tela de Login, caso contrário, envio direto para o cadastro.
     */
    if ($_POST['step'] == 0) {
        if ((isset($cpf) AND !empty($cpf)) AND Tools::checkCPF($cpf)) {
            $user = $system->serviceFindUserByCpf(array('cpf' => $cpf));

            if (isset($user->data) AND !empty($user->data)) {
                $step = 1;
            } else {
                $step = 2;
            }
        } else {
            $is_valid_cpf = FALSE;
        }
    }

    /*
     * Login do usuário.
     */
    if ($_POST['step'] == 1) {
        $data = array(
            'User' => array(
                'email' => $email,
                'password' => $password
            )
        );
        $user = $system->serviceLogin($data);

        if ($user->success) {
            $_SESSION['auth'] = $user;

            $step = 2;
        } else {
            $is_valid_login = FALSE;
        }
    }

    /*
    * Captura ou atualização de dados.
    */
    if ($_POST['step'] == 2) {
        try {
            $data = array(
                'User' => array(),
                'Sale' => array()
            );

            $data['User'] = array(
                'name' => $name,
                'cpf' => $cpf,
                'phone' => $phone,
                'phone_2' => $phone_2,
                'birth' => $birth,
                'cep' => $cep,
                'address' => $address,
                'state' => $state,
                'city' => $city,
                'neighborhood' => $neighborhood,
                'number' => $number,
                'complement' => $complement,
                'role_id' => 2,
                'active' => 1
            );

            if (isset($id) AND !empty($id)) {
                $data['User']['id'] = $id;
            } else {
                $data['User']['email'] = $email;
                $data['User']['password'] = $password;
                $data['User']['password_2'] = $password;
            }

            $data['Sale'] = array(
                'mp_value' => $courser->data->Course->value,
                'course_id' => $course_id,
                'step' => $step,
            );

            $_SESSION['data_sale'] = array();
            $_SESSION['data_sale']['User'] = $data['User'];
            $_SESSION['data_sale']['Sale'] = $data['Sale'];

            $_SESSION['data_sale']['User']['email'] = $email;
        } catch (ErrorException $e) {
            Tools::redirect(_PROJECT_ . 'error');
        }

        $step = 3;
    }

    /*
    * Checkout.
    */
    if ($_POST['step'] == 3) {
        $data = array(
            'items' => array(
                0 => array(
                    //'amount' => str_replace('.','',$courser->data->Course->value),
                    'amount' => 5,
                    'description' => $courser->data->Course->name,
                    'quantity' => 1
                )
            ),
            'customer' => array(
                'name' => $_SESSION['data_sale']['User']['name'],
                'email' => $_SESSION['data_sale']['User']['email'],
                //'document' => $_SESSION['data_sale']['User']['cpf'],
            ),
            'payments' => array(
                0 => array(
                    'payment_method' => 'checkout',
                    //'amount' => str_replace('.','',$courser->data->Course->value),
                    'amount' => 5,
                    'checkout' => array(
                        'accepted_payment_methods' => array('credit_card', 'boleto'),
                        'default_payment_method' => 'credit_card',
                        'success_url' => _PROJECT_ . 'retorno_da_compra',
                        'credit_card' => array(
                            //'capture' => true,
                            'statement_descriptor' => 'eHealthSchool Curso',
                            'installments' => array(
                                0 => array(
                                    'number' => 1,
                                    //'total' => str_replace('.','',$courser->data->Course->value)
                                    'total' => 5
                                )
                            )
                        ),
                        'boleto' => array(
                            'due_at' => date(date('Y-m-d'), strtotime('+7 days'))
                        ),
                        'billing_address' => array(
                            'zip_code' => $_SESSION['data_sale']['User']['cep'],
                            'street' => $_SESSION['data_sale']['User']['address'],
                            'number' => $_SESSION['data_sale']['User']['number'],
                            'complement' => $_SESSION['data_sale']['User']['complement'],
                            'neighborhood' => $_SESSION['data_sale']['User']['neighborhood'],
                            'city' => $_SESSION['data_sale']['User']['city'],
                            'state' => $_SESSION['data_sale']['User']['state'],
                            'country' => 'BR'
                        )
                    )
                )
            )
        );

        try {
            $mundipagg = new MundipaggCheckout(array(
                'secretKey' => $config['mundipagg']['secretKey'],
                'merchantKey' => $config['mundipagg']['merchantKey'],
                'sandbox' => $config['mundipagg']['sandbox'],
                'trust' => TRUE
            ));

            $response_checkout = $mundipagg->serviceCheckout($data);

            //Tools::dieObject($response_checkout);

            if (isset($response_checkout->checkouts[0]->payment_url) AND !empty($response_checkout->checkouts[0]->payment_url)) {
                $_SESSION['data_sale']['Sale']['mp_id'] = $response_checkout->id;
                $_SESSION['data_sale']['Sale']['mp_code'] = $response_checkout->code;
                $_SESSION['data_sale']['Sale']['mp_checkout_url'] = $response_checkout->checkouts[0]->payment_url;
                $_SESSION['data_sale']['Sale']['mp_created_at'] = $response_checkout->created_at;
                $_SESSION['data_sale']['Sale']['status'] = $response_checkout->status;

                if ($system->serviceSaveSale($_SESSION['data_sale'])) {
                    Tools::redirect($response_checkout->checkouts[0]->payment_url);
                } else {
                    Tools::redirect(_PROJECT_ . 'error');
                }
            } else {
                Tools::redirect(_PROJECT_ . 'error');
            }
        } catch (ErrorException $e) {
            Tools::redirect(_PROJECT_ . 'error');
        }
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
                        <?php if($step == 0){ ?>
                            <!-- Tela de informe de CPF. -->
                            <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                                <h2 class="style-03 noPaddingLeft">Informe seu CPF para iniciar sua matrícula</h2>
                                <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                            </div>
                            <div class="bg-grey-02">
                                <form id="form_registration_01" method="post">
                                    <?php if(isset($is_valid_cpf) AND !$is_valid_cpf){ ?>
                                        <div class="">
                                            <div class="alert alert-warning">
                                                CPF Inválido.
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="control-label">Informe seu CPF</label>
                                        <input type="text" name="cpf" class="form-control mask_cpf" placeholder="Informe seu CPF" validation="1">
                                    </div>

                                    <input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">
                                    <input type="hidden" name="url" value="<?php echo $_GET['url']; ?>">
                                    <input type="hidden" name="step" value="0">
                                    <button type="button" class="btn btn-site-02 btn_registration_01">Começar</button>
                                </form>
                            </div>
                        <?php } ?>
                        <?php if($step == 1){ ?>
                            <!-- Tela de Login. -->
                            <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                                <h2 class="style-03 noPaddingLeft">Login</h2>
                                <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                            </div>
                            <form id="form_login_02" method="post">
                                <?php if(isset($is_valid_login) AND !$is_valid_login){ ?>
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
                                            <button type="button" class="btn btn-site-02 btn_login_02">Avançar</button>

                                            <div class="text-center pdt-10">
                                                <a href="<?php echo _SYSTEM_; ?>Users/password_recover_1">Esqueci minha senha</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                        <?php if($step == 2){ ?>
                            <!-- Tela de Cadastro ou Atualização de Informações -->
                            <form id="form_registration_02" method="post">
                                <div class="pdb-50">
                                    <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                                        <h2 class="style-03 noPaddingLeft">Informe seus dados</h2>
                                        <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                                    </div>
                                    <div class="bg-grey-02">
                                        <div class="row">
                                            <div class="col-lg-12 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Nome Completo</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Nome Completo" validation="1" value="<?php echo ((isset($user->data->User->name) AND !empty($user->data->User->name)) ? $user->data->User->name : ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">CPF</label>
                                                    <input type="text" name="cpf" class="form-control mask_cpf" placeholder="CPF" validation="1" value="<?php echo ((isset($user->data->User->cpf) AND !empty($user->data->User->cpf)) ? $user->data->User->cpf : $cpf); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Celular</label>
                                                    <input type="text" name="phone" class="form-control mask_cellular" placeholder="Celular" validation="1" value="<?php echo ((isset($user->data->User->phone) AND !empty($user->data->User->phone)) ? $user->data->User->phone : ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Telefone</label>
                                                    <input type="text" name="phone_2" class="form-control mask_phone" placeholder="Telefone" validation="1" value="<?php echo ((isset($user->data->User->phone_2) AND !empty($user->data->User->phone_2)) ? $user->data->User->phone_2 : ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Data de Nascimento</label>
                                                    <input type="text" name="birth" class="form-control mask_date" placeholder="Data de Nascimento" validation="1" value="<?php echo ((isset($user->data->User->birth) AND !empty($user->data->User->birth)) ? date("d-m-Y", strtotime($user->data->User->birth)) : ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">CEP nº</label>
                                                    <input type="text" name="cep" class="form-control mask_cep find_cep" placeholder="CEP nº" number_parents="4" validation="1" value="<?php echo ((isset($user->data->User->cep) AND !empty($user->data->User->cep)) ? $user->data->User->cep : ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-8 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Endereço Completo</label>
                                                    <input type="text" name="address" class="form-control autocomplete_address" placeholder="Endereço completo" validation="1" value="<?php echo ((isset($user->data->User->address) AND !empty($user->data->User->address)) ? $user->data->User->address : ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Selecione o Estado</label>
                                                    <select name="state" class="form-control autocomplete_state">
                                                        <option value="">Selecione um Estado</option>
                                                        <?php foreach($states as $key => $row){ ?>
                                                            <option value="<?php echo $key; ?>" <?php echo ((isset($user->data->User->state) AND $key == $user->data->User->state) ? 'selected' : ''); ?>><?php echo $row; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Cidade</label>
                                                    <input type="text" name="city" class="form-control autocomplete_city" placeholder="Cidade" validation="1" value="<?php echo ((isset($user->data->User->city) AND !empty($user->data->User->city)) ? $user->data->User->city : ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Bairro</label>
                                                    <input type="text" name="neighborhood" class="form-control autocomplete_neighborhood" placeholder="Bairro" validation="1" value="<?php echo ((isset($user->data->User->neighborhood) AND !empty($user->data->User->neighborhood)) ? $user->data->User->neighborhood : ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Número</label>
                                                    <input type="text" name="number" class="form-control autocomplete_number" placeholder="Número" validation="1" value="<?php echo ((isset($user->data->User->number) AND !empty($user->data->User->number)) ? $user->data->User->number : ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4 m-b">
                                                <div class="form-group">
                                                    <label class="control-label">Complemento</label>
                                                    <input type="text" name="complement" class="form-control autocomplete_complement" placeholder="Complemento" validation="1" value="<?php echo ((isset($user->data->User->complement) AND !empty($user->data->User->complement)) ? $user->data->User->complement : ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!isset($user->data->User) OR empty($user->data->User)){ ?>
                                    <div class="pdb-50">
                                        <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                                            <h2 class="style-03 noPaddingLeft">Escolha seu Login</h2>
                                            <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                                        </div>
                                        <div class="bg-grey-02">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6 m-b">
                                                    <div class="form-group">
                                                        <label class="control-label">E-mail</label>
                                                        <input type="text" name="email" class="form-control" placeholder="E-mail" validation="1">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6 m-b">
                                                    <div class="form-group">
                                                        <label class="control-label">Senha</label>
                                                        <input id="register_password" type="password" name="password" class="form-control" placeholder="Senha" validation="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }else { ?>
                                    <input type="hidden" name="email" value="<?php echo ((isset($user->data->User->email) AND !empty($user->data->User->email)) ? $user->data->User->email : ''); ?>">
                                <?php } ?>

                                <input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">
                                <input type="hidden" name="url" value="<?php echo $_GET['url']; ?>">
                                <input type="hidden" name="step" value="2">
                                <input type="hidden" name="id" value="<?php echo ((isset($user->data->User->id) AND !empty($user->data->User->id)) ? $user->data->User->id : ''); ?>">

                                <div class="text-right">
                                    <a href="<?php echo _PROJECT_; ?>nossos_cursos" class="btn btn-site-05">Cancelar</a>
                                    <button type="button" class="btn btn-site-01 btn_registration_02">Avançar</button>
                                </div>
                            </form>
                        <?php } ?>
                        <?php if($step == 3){ ?>
                            <!-- Confirmação -->
                            <div class="vc_separator vc_sep_dotted vc_sep_pos_align_center pdb-50">
                                <h2 class="style-03 noPaddingLeft">Finalização de Matrícula e Pagamento</h2>
                                <span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#808080;" class="vc_sep_line"></span></span>
                            </div>
                            <form id="form_registration_03" method="post">
                                <div class="pdb-50">
                                    <div class="bg-grey-02">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <b>Nome do Curso:</b>
                                                <?php echo $courser->data->Course->name; ?>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <b>Valor:</b>
                                                <?php echo Tools::convertReal($courser->data->Course->value, 'R$ '); ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <b>Nome Completo:</b>
                                                <?php echo $_SESSION['data_sale']['User']['name']; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <b>CPF:</b>
                                                <?php echo $_SESSION['data_sale']['User']['cpf']; ?>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <b>Telefone:</b>
                                                <?php echo $_SESSION['data_sale']['User']['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <b>Data de Nascimento:</b>
                                                <?php echo $_SESSION['data_sale']['User']['birth']; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                <b>CEP:</b>
                                                <?php echo $_SESSION['data_sale']['User']['cep']; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <b>Endereço:</b>
                                                <?php echo $_SESSION['data_sale']['User']['address']; ?>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <b>Estado:</b>
                                                <?php echo $_SESSION['data_sale']['User']['state']; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <b>Cidade:</b>
                                                <?php echo $_SESSION['data_sale']['User']['city']; ?>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <b>Bairro:</b>
                                                <?php echo $_SESSION['data_sale']['User']['neighborhood']; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <b>Número:</b>
                                                <?php echo $_SESSION['data_sale']['User']['number']; ?>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <b>Complemento:</b>
                                                <?php echo $_SESSION['data_sale']['User']['complement']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">
                                <input type="hidden" name="url" value="<?php echo $_GET['url']; ?>">
                                <input type="hidden" name="step" value="3">
                                <input type="hidden" name="id" value="<?php echo ((isset($user->data->User->id) AND !empty($user->data->User->id)) ? $user->data->User->id : ''); ?>">

                                <div class="text-right">
                                    <a href="<?php echo _PROJECT_; ?>nossos_cursos" class="btn btn-site-05">Cancelar</a>
                                    <button type="button" class="btn btn-site-01 btn_registration_03">Avançar</button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                    <div class="col-xs-12 col-md-4 pdb-50">
                        <div class="pdb-50">
                            <div class="steps-div">
                                <span class="arrow <?php echo (($step == 0 OR $step == 1) ? 'active' : ''); ?>">01</span> Indentificação
                            </div>
                            <div class="steps-div">
                                <span class="arrow <?php echo (($step == 2) ? 'active' : ''); ?>">02</span> Dados
                            </div>
                            <div class="steps-div">
                                <span class="arrow <?php echo (($step == 3) ? 'active' : ''); ?>">03</span> Confirmação
                            </div>
                        </div>
                        <div class="pdb-20">
                            <p>Pagamento seguro.</p>
                            <img src="<?php echo _PROJECT_; ?>img/logo_mundipagg.png" class="img-responsive" style="max-height: 50px;" alt="MundiPagg" title="MundiPagg">
                        </div>
                        <img src="<?php echo _PROJECT_; ?>img/aceitamos-1.png" class="img-responsive" alt="Formar de Pagamento" title="Formar de Pagamento">
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include_once('inc/footer.php'); ?>

<script>
    $('.btn_registration_01').on('click', function (e){
        e.preventDefault();

        var submit = true;
        var data = $('#form_registration_01 input, #form_registration_01 textarea, #form_registration_01 select').serialize();

        $('#form_registration_01 input, #form_registration_01 textarea, #form_registration_01 select').each(function (){
            if (parseInt($(this).attr('validation')) == 1 && $(this).val() == "") {
                $(this).parent().addClass('error');
                submit = false;
            } else {
                $(this).parent().removeClass('error');
            }
        });

        if (submit == true) {
            $('#form_registration_01').submit();
        } else {
            toastr.error('Preencha os campos obrigatórios');
        }
    });
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
    $('.btn_registration_02').on('click', function (e){
        e.preventDefault();

        var submit = true;
        var data = $('#form_registration_02 input, #form_registration_02 textarea, #form_registration_02 select').serialize();

        $('#form_registration_02 input, #form_registration_02 textarea, #form_registration_02 select').each(function (){
            if (parseInt($(this).attr('validation')) == 1 && $(this).val() == "") {
                $(this).parent().addClass('error');
                submit = false;
            } else {
                $(this).parent().removeClass('error');
            }
        });

        <?php if(!isset($user->data->User) OR empty($user->data->User)){ ?>
            if ($('#register_password').val().length < 6) {
                app.inlineFieldAlert('add', 'input', $('#register_password'), 'A senha deve ser superior a 6 dígitos.', 'warning', false);
                submit = false;
            } else {
                app.inlineFieldAlert('clean', 'input', $('#register_password'));
            }
        <?php } ?>

        if (submit == true) {
            $('#form_registration_02').submit();
        } else {
            toastr.error('Preencha os campos obrigatórios');
        }
    });
    $('.btn_registration_03').on('click', function (e){
        e.preventDefault();

        var submit = true;
        var data = $('#form_registration_03 input, #form_registration_03 textarea, #form_registration_03 select').serialize();

        $('#form_registration_03 input, #form_registration_03 textarea, #form_registration_03 select').each(function (){
            if (parseInt($(this).attr('validation')) == 1 && $(this).val() == "") {
                $(this).parent().addClass('error');
                submit = false;
            } else {
                $(this).parent().removeClass('error');
            }
        });

        if (submit == true) {
            $('#form_registration_03').submit();
        } else {
            toastr.error('Preencha os campos obrigatórios');
        }
    });
</script>
