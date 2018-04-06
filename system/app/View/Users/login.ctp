<div class="login text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <a href="<?php echo $this->webroot ?>">
                <img src="<?php echo $this->webroot; ?>img/logo.png" style="max-width: 160px;">
            </a>
        </div>
        <?php echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'login', 'class' => 'm-t')); ?>
            <div id="email" class="form-group">
                <?php echo $this->Form->input('User.email', array('type' => 'text', 'div' => false, 'class' => 'form-control', 'label' => false, 'placeholder' => 'E-mail')); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('User.password', array('div' => false, 'class' => 'form-control', 'label' => false, 'placeholder' => 'Senha')); ?>
            </div>
            <?php echo $this->Form->submit('Entrar', array('class' => 'btn btn-primary block full-width m-b', 'div'=>false));?>
        <?php echo $this->Form->end(); ?>
    </div>
    <div>
        <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'password_recover_1')); ?>">Esqueci minha senha</a>
    </div>
    <span><?php echo $this->Session->flash(); ?></span>
</div>