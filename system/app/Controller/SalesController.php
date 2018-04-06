<?php
App::uses('AppController', 'Controller');
App::uses('DateHelper', 'View/Helper');
App::uses('ToolHelper', 'View/Helper');

class SalesController extends AppController
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
        $this->Paginator->settings = array('order' => array('Sale.created' => 'DESC'));

        $q = '';
        $where = array();
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $where = array(
                'OR' => array(
                    'Sale.name LIKE' => '%' . $q . '%'
                )
            );
        }

        $this->set(array('q' => $q, 'list' => $this->Paginator->paginate('Sale', $where)));
        $this->loadCombos();
    }

    public function view($id = NULL)
    {
        if (!$this->Sale->exists($id)) {
            $this->Session->setFlash('A compra não pode ser encontrada.', 'warning');
            $this->redirect(array('action' => 'index'));
        }

        $this->request->data = $this->Sale->find('first', array(
            'conditions' => 'Sale.id = ' . $id
        ));

        $this->set(compact('id'));

        $this->loadCombos();
    }

    private function loadCombos()
    {
        //$this->set(compact(''));
    }
}