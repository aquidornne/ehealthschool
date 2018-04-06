<?php
App::uses('AppController', 'Controller');

class RolesController extends AppController
{
    public function isAuthorized($user)
    {
        return $this->hasPermission(SimplePermission::ManageAll);
    }

    public function index()
    {
        $q = '';
        $where = array();
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $where = array('Role.name LIKE' => '%' . $q . '%');
        }
        $this->set('q', $q);
        $this->set('list', $this->Paginator->paginate('Role', $where));
    }

    public function add()
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Role->create();
            if ($this->Role->save($this->request->data)) {
                $this->Session->setFlash('O perfil foi criado com sucesso.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('O perfil não foi criado.', 'failure');
            }
        }

        $this->loadPermissions();
    }

    public function edit($id = null)
    {
        if (empty($id) || !$this->Role->exists($id))
            $this->redirect(array('action' => 'index'));

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Role->id = $id;
            if ($this->Role->save($this->request->data)) {
                $this->Session->setFlash('O perfil foi alterado com sucesso.', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('O perfil não foi alterado.', 'failure');
            }
        } else {
            $this->request->data = $this->Role->find('first', array(
                'contain' => array('RolePermission'),
                'conditions' => array('Role.id' => $id)
            ));
        }

        $this->loadPermissions();
    }

    public function remove($id = null)
    {
        if (empty($id) || !$this->Role->exists($id))
            $this->redirect(array('action' => 'index'));

        $this->Role->id = $id;
        if ($this->Role->delete($id, false)) {
            $this->Session->setFlash('O perfil foi removido com sucesso.', 'success');
        } else {
            $this->Session->setFlash('O perfil não foi removido.', 'failure');
        }

        $this->redirect(array('action' => 'index'));
    }

    private function loadPermissions(){
        $permissions = new ReflectionClass('SimplePermission');
        $this->set('permissions', array_flip($permissions->getConstants()));
    }
}