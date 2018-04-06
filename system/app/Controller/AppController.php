<?php
App::uses('Controller', 'Controller');
App::uses('ModelBehavior', 'Model');

class AppController extends Controller
{
    public $keyServices = "2ab64f0053ff977a9a1093642cd993df";

    public $eadbox_admin_email = 'daniel@visanacomunicacao.com.br';
    public $eadbox_admin_password = 'Bananada@1';

    public $sitePath = "../../../";

    public $components = array(
        'Session',
        'Paginator',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'Pages', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'Users', 'action' => 'login'),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            ),
            'authError' => "Você não está autorizado a fazer isso!",
            'flash' => array('element' => 'auth', 'key' => 'auth', 'params' => array()),
            'authorize' => array('Controller')
        ),
        'RequestHandler'
    );

    public $helpers = array('Form', 'FormX', 'Html', 'TextX', 'Money', 'Date');

    public function beforeFilter()
    {
        parent::beforeFilter();

        //if($this->Auth->loggedIn()) { }

        Configure::write('Config.language', 'ptb');

        $this->Auth->deny('*');
    }

    protected function hasPermission($permission)
    {
        $this->loadModel('Role');
        return $this->Role->HasPermission(AuthComponent::user('role_id'), $permission);
    }
}

abstract class SimplePermission
{
    const ManageAll = 4;
}