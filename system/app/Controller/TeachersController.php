<?php
App::uses('AppController', 'Controller');
App::uses('DateHelper', 'View/Helper');
App::uses('Money2Helper', 'View/Helper');
App::uses('ToolHelper', 'View/Helper');

class TeachersController extends AppController
{
    public $helpers = array('Date', 'Tool');

    function beforeFilter()
    {
        parent::beforeFilter();
        //            $this->Auth->allow(array(''));
    }

    public function isAuthorized($user)
    {
        return $this->hasPermission(SimplePermission::ManageAll);
    }

    public function index()
    {
        $this->Paginator->settings = array('order' => array('Teacher.created' => 'DESC'));

        $where = array(
            'OR' => array(),
            'AND' => array()
        );

        $q = '';
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $where['OR'][] = array(
                'Teacher.name LIKE' => '%' . $q . '%'
            );
        }

        $this->set(array(
                'q' => $q,
                'list' => $this->Paginator->paginate('Teacher', $where)
            )
        );
        $this->loadCombos();
    }

    public function add()
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Teacher->create();
            if ($this->Teacher->save($this->request->data)) {
                $this->Session->setFlash('Professor cadastrado com sucesso!', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
            }
        }

        $this->loadCombos();
    }

    public function edit($id = NULL)
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Teacher->id = $id;
            if ($this->Teacher->save($this->request->data)) {
                $this->Session->setFlash('O Professor foi atualizado com sucesso!', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
            }
        } else {
            $this->request->data = $this->Teacher->findById($id);
        }

        $this->set(compact('id'));

        $this->loadCombos();
    }

    public function view($id = NULL)
    {
        if (!$this->Teacher->exists($id)) {
            $this->Session->setFlash('O Professor não pode ser encontrado.', 'warning');
            $this->redirect(array('action' => 'index'));
        }

        $this->request->data = $this->Teacher->find('first', array(
            'conditions' => 'Teacher.id = ' . $id
        ));

        $this->set(compact('id'));

        $this->loadCombos();
    }

    public function remove($id = NULL)
    {
        if (empty($id) || !$this->Teacher->exists($id))
            $this->redirect(array('action' => 'index'));

        $this->Teacher->id = $id;
        if ($this->Teacher->delete($id, FALSE)) {
            $this->Session->setFlash('O Professor foi removido com sucesso.', 'success');
            $this->redirect(array('controller' => 'Teachers', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
        }

        $this->redirect(array('action' => 'index'));
    }

    private function loadCombos()
    {
    }
}