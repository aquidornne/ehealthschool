<?php
App::uses('AppController', 'Controller');
App::uses('DateHelper', 'View/Helper');
App::uses('ToolHelper', 'View/Helper');

class NewslettersController extends AppController
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
        $this->Paginator->settings = array('order' => array('Newsletter.created' => 'DESC'));

        $where = array(
            'OR' => array(),
            'AND' => array()
        );

        $q = '';
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $where['OR'][] = array(
                'Newsletter.name LIKE' => '%' . $q . '%'
            );
        }

        $this->set(array(
                'q' => $q,
                'list' => $this->Paginator->paginate('Newsletter', $where)
            )
        );
    }

    public function edit($id = NULL)
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Newsletter->id = $id;
            if ($this->Newsletter->saveAll($this->request->data)) {
                $this->Session->setFlash('O Contato foi atualizado com sucesso!', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
            }
        } else {
            $this->request->data = $this->Newsletter->findById($id);
        }

        $this->set(compact('id'));
    }

    public function remove($id = NULL)
    {
        if (empty($id) || !$this->Newsletter->exists($id))
            $this->redirect(array('action' => 'index'));

        $this->Newsletter->id = $id;
        if ($this->Newsletter->delete($id, FALSE)) {
            $this->Session->setFlash('O Contato foi removido com sucesso.', 'success');
            $this->redirect(array('controller' => 'Newsletters', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
        }

        $this->redirect(array('action' => 'index'));
    }
}