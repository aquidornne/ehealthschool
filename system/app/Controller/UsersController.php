<?php
App::uses('AppController', 'Controller');
App::uses('ToolHelper', 'View/Helper');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController
{
    public function isAuthorized($user)
    {
        return $this->hasPermission(SimplePermission::ManageAll);
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array(
            'login',
            'password_recover_1',
            'password_recover_2'
        ));
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

        $where['AND'][] = array('User.role_id' => 1);

        $this->set(compact('q', 'role_id'));
        $this->set('list', $this->Paginator->paginate('User', $where));

        $this->loadCombos();
    }

    public function add()
    {
        if ($this->Session->read('Auth.User.role_id') != 1) {
            $this->Session->setFlash('Acesso negado.', 'warning');
            $this->redirect(array('controller' => 'Users', 'action' => 'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('O usuário foi criado com sucesso.', 'success');
                $this->redirect(array('controller' => 'Users', 'action' => 'index'));
            } else {
                $this->Session->setFlash('O usuário não foi criado.', 'warning');
            }
        }

        $this->loadCombos();
    }

    public function edit($id = null)
    {
        if ($this->Session->read('Auth.User.role_id') != 1) {
            $this->Session->setFlash('Você não tem acesso a essa área.', 'warning');
            $this->redirect(array('controller' => 'Users', 'action' => 'index'));
        }

        if (!$this->User->exists($id))
            $this->redirect(array('controller' => 'Users', 'action' => 'index'));

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('O usuário foi alterado com sucesso.', 'success');
                $this->redirect(array('controller' => 'Users', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Ocorreu algum erro, tente novamente mais tarde.', 'warning');
            }
        } else {
            $this->request->data = $this->User->findById($id);
        }

        $this->set(compact(
                'id'
            )
        );

        $this->loadCombos();
    }

    public function login()
    {
        $this->layout = 'login';

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if($this->Session->read('Auth.User.role_id') == 2){
                    $this->redirect($this->Auth->logout());
                }

                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Dados incorretos. Tente novamente.', 'auth');
                $this->redirect(array('controller' => 'Users', 'action' => 'login'));
            }
        }
    }

    public function password_recover_1()
    {
        $this->layout = 'login';

        $toolhelper = new ToolHelper(new View());

        if ($this->request->is('post')) {
            $data_user_1 = $this->User->findByEmail($this->request->data['User']['email']);
            if (!empty($data_user_1)) {
                $data_user_2 = array(
                    'User' => array(
                        'id' => $data_user_1['User']['id'],
                        'token' => $toolhelper->getToken()
                    )
                );
                if ($this->User->save($data_user_2)) {
                    try {
                        $Email = new CakeEmail();
                        $Email->config('noreply');
                        $t = $Email->template('password_recover')
                            ->subject('Notificação')
                            ->viewVars(
                                array(
                                    'token' => $data_user_2['User']['token'],
                                    'logotipo_url' => $this->masterConfig['logotipo_url']
                                )
                            )
                            ->emailFormat('html')
                            ->to($data_user_1['User']['email'])
                            ->send();
                        $this->Session->setFlash('Enviamos para seu e-mail o link de reperação.', 'success');
                        $this->redirect(array('controller' => 'Users', 'action' => 'login'));
                    } catch (ErrorException $e) {
                        $this->Session->setFlash('Ocorreu algum erro, tente novamente mais tarde.', 'auth');
                        $this->redirect(array('controller' => 'Users', 'action' => 'password_recover_1'));
                    }
                } else {
                    $this->Session->setFlash('Ocorreu algum erro, tente novamente mais tarde.', 'auth');
                    $this->redirect(array('controller' => 'Users', 'action' => 'password_recover_1'));
                }
            } else {
                $this->Session->setFlash('Não há em nosso banco de dados login relacionado ao e-mail informado.', 'auth');
                $this->redirect(array('controller' => 'Users', 'action' => 'password_recover_1'));
            }
        }
    }

    public function password_recover_2($token = NULL)
    {
        $this->layout = 'login';

        if ($this->request->is('post') || $this->request->is('put')) {
            $data_user_2 = array(
                'User' => array(
                    'id' => $this->request->data['User']['id'],
                    'password' => $this->request->data['User']['password'],
                )
            );

            if ($this->request->data['User']['role_id'] == 3) {
                $data_user_2['User']['password_2'] = $this->request->data['User']['password'];
            }

            if ($this->User->save($data_user_2)) {
                $this->Session->setFlash('Senha alterada com sucesso, faça login!', 'success');
                $this->redirect('https://www.ehealthschool.com.br/');
            } else {
                $this->Session->setFlash('Ocorreu algum erro, tente novamente mais tarde.', 'auth');
                $this->redirect(array('controller' => 'Users', 'action' => 'password_recover_2', $this->request->data['User']['token']));
            }
        } else {
            if (!isset($token) OR empty($token)) {
                $this->Session->setFlash('Ocorreu algum erro, tente novamente mais tarde.', 'auth');
                $this->redirect(array('controller' => 'Users', 'action' => 'login'));
            }

            $this->request->data = $this->User->findByToken($token);

            if (empty($this->request->data)) {
                $this->Session->setFlash('Ocorreu algum erro, tente novamente mais tarde.', 'auth');
                $this->redirect(array('controller' => 'Users', 'action' => 'password_recover_2', $this->request->data['User']['token']));
            } else {
                $this->set(compact(
                        'token',
                        'data_user_1'
                    )
                );
            }
        }
    }

    public function logout()
    {
        $this->redirect($this->Auth->logout());
    }

    private function loadCombos()
    {
        $this->loadModel('Role');
        $roles = $this->Role->find('all', array('order' => array('Role.name' => 'asc')));
        $roles = Set::combine($roles, '{n}.Role.id', '{n}.Role.name');
        $this->set('roles', $roles);
    }
}