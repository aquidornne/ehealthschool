<div class="login text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <a href="<?php echo $this->webroot ?>">
                <img src="<?php echo $this->webroot; ?>img/logo.png" style="max-width: 160px;">
            </a>
        </div>
        <?php echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'password_recover_1', 'class' => 'm-t')); ?>
            <h3>Informe seu e-mail de cadastro.</h3>
            <div id="email" class="form-group">
                <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'class' => 'form-control', 'label' => false, 'placeholder' => 'E-mail')); ?>
            </div>
            <?php echo $this->Form->submit('Recuperar senha', array('class' => 'btn btn-primary block full-width m-b', 'div' => false));?>
            <?php echo $this->Form->end(); ?>
    </div>
    <div>
        <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'login')); ?>">Login</a>
    </div>
    <span><?php echo $this->Session->flash(); ?></span>
</div>