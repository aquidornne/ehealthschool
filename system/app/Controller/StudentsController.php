<?php
App::uses('AppController', 'Controller');
App::uses('ToolHelper', 'View/Helper');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'eadbox/EADBoxIntegration');

class StudentsController extends AppController
{
    public function isAuthorized($user)
    {
        return $this->hasPermission(SimplePermission::ManageAll);
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel('User');
    }

    public function index()
    {
        $this->Paginator->settings = array(
            'contain' => array('Role')
        );

        $q = '';
        $where = array(
            'AND' => array()
        );

        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $where = array('OR' => array(
                'User.name LIKE' => '%' . $q . '%',
                'User.email LIKE' => '%' . $q . '%',
                'Role.name LIKE' => '%' . $q . '%',
            ));
        }

        $where['AND'][] = array('User.role_id' => 2);

        $this->set(compact('q'));
        $this->set('list', $this->Paginator->paginate('User', $where));

        $this->loadCombos();
    }

    public function add()
    {
        if ($this->Session->read('Auth.User.role_id') != 1) {
            $this->Session->setFlash('Acesso negado.', 'warning');
            $this->redirect(array('controller' => 'Students', 'action' => 'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $eadbox = new EADBoxIntegration(array(
                'trust' => FALSE
            ));

            $eadbox_auth = $eadbox->login(array(
                'email' => $this->eadbox_admin_email,
                'password' => $this->eadbox_admin_password
            ));

            $save_user = $eadbox->signup(array(
                'authentication_token' => $eadbox_auth->authentication_token,
                'email' => $this->request->data['User']['email'],
                'password' => $this->request->data['User']['password_2'],
                'password_confirmation' => $this->request->data['User']['password_2'],
                'name' => $this->request->data['User']['name']
            ));

            if ($save_user->valid) {
                $this->request->data['User']['eadbox_id'] = $save_user->user->user_id;
                $this->request->data['User']['eadbox_slug'] = $save_user->user->user_slug;

                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash('O aluno foi criado com sucesso.', 'success');
                    $this->redirect(array('controller' => 'Students', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('O aluno não foi criado.', 'warning');
                }
            } else {
                $this->Session->setFlash('O aluno não foi criado.', 'warning');
            }
        }
    }

    public function edit($id = null)
    {
        if ($this->Session->read('Auth.User.role_id') != 1) {
            $this->Session->setFlash('Você não tem acesso a essa área.', 'warning');
            $this->redirect(array('controller' => 'Students', 'action' => 'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!isset($this->request->data['User']['eadbox_id']) OR empty($this->request->data['User']['eadbox_id'])) {
                $eadbox = new EADBoxIntegration(array(
                    'trust' => FALSE
                ));

                $eadbox_auth = $eadbox->login(array(
                    'email' => $this->eadbox_admin_email,
                    'password' => $this->eadbox_admin_password
                ));

                $save_user = $eadbox->signup(array(
                    'authentication_token' => $eadbox_auth->authentication_token,
                    'email' => $this->request->data['User']['email'],
                    'password' => $this->request->data['User']['password_2'],
                    'password_confirmation' => $this->request->data['User']['password_2'],
                    'name' => $this->request->data['User']['name']
                ));

                if ($save_user->valid) {
                    $this->request->data['User']['eadbox_id'] = $save_user->user->user_id;
                    $this->request->data['User']['eadbox_slug'] = $save_user->user->user_slug;
                } else {
                    $this->Session->setFlash('O aluno não foi criado.', 'warning');
                }
            }

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('O aluno foi alterado com sucesso.', 'success');
                $this->redirect(array('controller' => 'Students', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Ocorreu algum erro, tente novamente mais tarde.', 'warning');
            }
        } else {
            if (!$this->User->exists($id)){
                $this->redirect(array('controller' => 'Students', 'action' => 'index'));
            }

            $this->request->data = $this->User->findById($id);

            if (isset($this->request->data['User']['password']) AND !empty($this->request->data['User']['password'])) {
                unset($this->request->data['User']['password']);
            }
            if (isset($this->request->data['User']['password_2']) AND !empty($this->request->data['User']['password_2'])) {
                unset($this->request->data['User']['password_2']);
            }
        }

        $this->set(compact(
                'id'
            )
        );
    }

    private function loadCombos()
    {
        $this->loadModel('Course');
        $courses = $this->Course->find('all', array('order' => array('Course.name' => 'asc')));
        $courses = Set::combine($courses, '{n}.Course.id', '{n}.Course.name');
        $this->set('courses', $courses);
    }
}