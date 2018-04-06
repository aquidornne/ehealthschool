<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element text-center">
                    <span>
                        <a href="<?php echo $this->webroot; ?>" class="img-circle"><img src="<?php echo $this->webroot; ?>img/logo_2.png" style="max-width: 180px;"></a>
                    </span>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'edit', $this->Session->read('Auth.User.id'))); ?>">Profile</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    R+
                </div>
            </li>
            <li class="<?php echo $this->Css->menu_active('Pages', 'index'); ?>">
                <a href="<?php echo $this->Html->url(array('controller' => 'Pages', 'action' => 'index')); ?>"><i class="fa fa-home"></i> <span class="nav-label">Início</span></a>
            </li>
            <li class="<?php echo $this->Css->menu_active('Sales'); ?>">
                <a href="<?php echo $this->Html->url(array('controller' => 'Sales', 'action' => 'index')); ?>"><i class="fa fa-paper-plane-o"></i> <span class="nav-label">Vendas</span></a>
            </li>
            <li class="<?php echo $this->Css->menu_active('Courses'); ?><?php echo $this->Css->menu_active('CourseCategories'); ?><?php echo $this->Css->menu_active('Teachers'); ?><?php echo $this->Css->menu_active('Students'); ?>">
                <a href="#"><i class="fa fa-mortar-board"></i> <span class="nav-label">Cursos</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $this->Css->menu_active('Courses'); ?>">
                        <a href="<?php echo $this->Html->url(array('controller' => 'Courses', 'action' => 'index')); ?>"><i class="fa fa-mortar-board"></i> <span class="nav-label">Cursos</span></a>
                    </li>
                    <li class="<?php echo $this->Css->menu_active('CourseCategories'); ?>">
                        <a href="<?php echo $this->Html->url(array('controller' => 'CourseCategories', 'action' => 'index')); ?>"><i class="fa fa-ellipsis-h"></i> <span class="nav-label">Categorias</span></a>
                    </li>
                    <li class="<?php echo $this->Css->menu_active('Teachers'); ?>">
                        <a href="<?php echo $this->Html->url(array('controller' => 'Teachers', 'action' => 'index')); ?>"><i class="fa fa-user"></i> <span class="nav-label">Professores</span></a>
                    </li>
                    <li class="<?php echo $this->Css->menu_active('Students'); ?>">
                        <a href="<?php echo $this->Html->url(array('controller' => 'Students', 'action' => 'index')); ?>"><i class="fa fa-user"></i> <span class="nav-label">Alunos</span></a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo $this->Css->menu_active('Banners'); ?>">
                <a href="<?php echo $this->Html->url(array('controller' => 'Banners', 'action' => 'index')); ?>"><i class="fa fa-list-alt"></i> <span class="nav-label">Banners</span></a>
            </li>
            <li class="<?php echo $this->Css->menu_active('Newsletters'); ?>">
                <a href="<?php echo $this->Html->url(array('controller' => 'Newsletters', 'action' => 'index')); ?>"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Contatos</span></a>
            </li>
            <li class="<?php echo $this->Css->menu_active('Pages', 'configs'); ?><?php echo $this->Css->menu_active('Users'); ?><?php echo $this->Css->menu_active('Teachers'); ?>">
                <a href="<?php echo $this->Html->url(array('controller' => 'Pages', 'action' => 'configs')); ?>"><i class="glyphicon glyphicon-wrench"></i> <span class="nav-label">Opções</span></a>
            </li>
        </ul>
    </div>
</nav>