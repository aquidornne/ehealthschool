<?php require('init.php'); ?>
<?php
global $page_current;

$page_current = 'return_buy';

$success = FALSE;

/*
 * Recupero os dados da transação bancária do mundipagg.
 */
if (!isset($_GET['order_id']) AND empty($_GET['order_id'])) {
    Tools::redirect(_PROJECT_ . 'error');
}

$mundipagg = new MundipaggCheckout(array(
    'secretKey' => $config['mundipagg']['secretKey'],
    'merchantKey' => $config['mundipagg']['merchantKey'],
    'sandbox' => $config['mundipagg']['sandbox'],
    'trust' => TRUE
));

$response_checkout = $mundipagg->serviceCheckoutReturn($_GET['order_id']);

if ($response_checkout->status == 'paid') {
    $success = TRUE;
}
#- ---------------------------------------------------------------------------------------------------------------------

if ($success) {
    /*
    * Atualizo o registro da venda.
    */
    $sale = $system->serviceFindSale(array('mp_code' => $response_checkout->code));

    $data_sale = array(
        'Sale' => array(
            'id' => $sale->data->Sale->id,
            'status' => $response_checkout->status,
        )
    );

    if ($system->serviceSaveSale($data_sale)) {
        /*
        * Crio os dados do EADBox se o a transação bancária for bem sucedida.
        */
        try {
            $eadbox = new EADBoxIntegration(array(
                'trust' => FALSE
            ));

            $eadbox_auth = $eadbox->login(array(
                'email' => $config['eadbox']['email'],
                'password' => $config['eadbox']['password']
            ));

            if (isset($sale->data->User->eadbox_id) AND !empty($sale->data->User->eadbox_id)) {
                #- Adicionar curso ao usuário.
                $save_subscriptions = $eadbox->subscriptions(array(
                    'user_id' => $sale->data->User->eadbox_id,
                    'course_id' => $sale->data->Course->eadbox_id,
                    'auth_token' => $eadbox_auth->authentication_token
                ));
                if (!$save_subscriptions->valid) {
                    Tools::redirect(_PROJECT_ . 'error');
                }
            } else {
                $save_user = $eadbox->signup(array(
                    'authentication_token' => $eadbox_auth->authentication_token,
                    'email' => $sale->data->User->email,
                    'password' => $sale->data->User->password_2,
                    'password_confirmation' => $sale->data->User->password_2,
                    'name' => $sale->data->User->first_name . ' ' . $sale->data->User->last_name
                ));
                if ($save_user->valid) {
                    $data_user = array(
                        'User' => array(
                            'id' => $sale->data->User->id,
                            'eadbox_id' => $save_user->user->user_id,
                            'eadbox_slug' => $save_user->user->user_slug
                        )
                    );

                    if ($system-> serviceSaveUser($data_user)) {
                        #- Adicionar curso ao usuário.
                        $save_subscriptions = $eadbox->subscriptions(array(
                            'user_id' => $save_user->user->user_id,
                            'course_slug' => $sale->data->Course->eadbox_id,
                            'auth_token' => $eadbox_auth->authentication_token
                        ));
                        if (!$save_subscriptions->valid) {
                            Tools::redirect(_PROJECT_ . 'error');
                        }
                        #- ---------------------------------------------------------------------------------------------
                    }
                } else {
                    Tools::redirect(_PROJECT_ . 'error');
                }
            }
        } catch (ErrorException $e) {
            Tools::redirect(_PROJECT_ . 'error');
        }
    }
#- ---------------------------------------------------------------------------------------------------------------------
}
?>

<?php include_once('inc/header.php'); ?>
<main>
    <?php if ($success) { ?>
        <section id="" class="internal-pages-header">
            <div class="container pdt-10 pdb-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="no-margin style-02">Seja Bem Vindo Aluno!</h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="">
            <div class="container pdt-100 pdb-100">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>É uma honra telo conosco, a partir de agora você pode acessar nossa plataforma com seu
                            usuário escolhido. <a href="<?php echo _PROJECT_ ?>login">Clique aqui para fazer login</a>
                        </h4>
                    </div>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section id="" class="internal-pages-header-02">
            <div class="container pdt-10 pdb-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="no-margin style-02">Infelizmente, sua transação parece não ter sido bem sucedida.</h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="">
            <div class="container pdt-100 pdb-100">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Se isso for um engano, entre em contato com nosso suporte para avaliarmos o ocorrido. <a
                                    href="<?php echo _PROJECT_ ?>fale_conosco">Entre em contato clicando aqui</a></h4>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</main>
<?php include_once('inc/footer.php'); ?>
