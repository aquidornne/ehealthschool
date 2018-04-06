<?php
App::uses('AppController', 'Controller');
App::uses('DateHelper', 'View/Helper');
App::uses('Money2Helper', 'View/Helper');
App::uses('ToolHelper', 'View/Helper');

class BannersController extends AppController
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
        $this->Paginator->settings = array('order' => array('Banner.created' => 'DESC'));

        $where = array(
            'OR' => array(),
            'AND' => array()
        );

        $q = '';
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $where['OR'][] = array(
                'Banner.comments LIKE' => '%' . $q . '%'
            );
        }

        $this->set(array(
                'q' => $q,
                'list' => $this->Paginator->paginate('Banner', $where)
            )
        );
        $this->loadCombos();
    }

    public function add()
    {
        $toolhelper = new ToolHelper(new View());

        if ($this->request->is('post') || $this->request->is('put')) {

            $data = array();

            if (isset($_FILES['banners']['name'][0]) AND !empty($_FILES['banners']['name'][0])) {
                $banners = $toolhelper->reArrayFiles($_FILES['banners']);
                foreach ($banners as $key => $row) {
                    $file = $toolhelper->uploadFile($row, 'banners');

                    if ($file['success']) {
                        $data[$key]['Banner']['file'] = $file['file'];
                        $data[$key]['Banner']['comments'] = $this->request->data['Banner']['comments'];
                        $data[$key]['Banner']['is_mobile'] = $this->request->data['Banner']['is_mobile'];
                    }

                }
            }

            $this->Banner->create();
            if ($this->Banner->saveAll($data, array('DEEP' => TRUE))) {
                $this->Session->setFlash('Banner(s) cadastrado(s) com sucesso!', 'success');
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

            $this->Banner->id = $id;
            if ($this->Banner->saveAll($this->request->data, array('DEEP' => TRUE))) {
                $this->Session->setFlash('O banner foi atualizado com sucesso!', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
            }
        } else {
            $this->request->data = $this->Banner->findById($id);
        }

        $this->set(compact('id'));

        $this->loadCombos();
    }

    public function view($id = NULL)
    {
        if (!$this->Banner->exists($id)) {
            $this->Session->setFlash('O banner não pode ser encontrado.', 'warning');
            $this->redirect(array('action' => 'index'));
        }

        $this->request->data = $this->Banner->find('first', array(
            'conditions' => 'Banner.id = ' . $id
        ));

        $this->set(compact('id'));

        $this->loadCombos();
    }

    public function remove($id = NULL, $photo = NULL)
    {
        if (empty($id) || !$this->Banner->exists($id))
            $this->redirect(array('action' => 'index'));

        $this->Banner->id = $id;
        if ($this->Banner->delete($id, FALSE)) {
            @unlink(unlink(WWW_ROOT . 'files' . '/' . 'banners' . '/' . $photo));

            $this->Session->setFlash('O banner foi removida com sucesso.', 'success');
            $this->redirect(array('controller' => 'Banners', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
        }

        $this->redirect(array('action' => 'index'));
    }

    private function loadCombos()
    {
    }
}