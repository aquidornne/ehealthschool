<?php
App::uses('AppController', 'Controller');

class CourseCategoriesController extends AppController
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
        $this->Paginator->settings = array('order' => array('CourseCategory.title' => 'DESC'));

        $q = '';
        $where = array();
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $where = array(
                'OR' => array(
                    'CourseCategory.title LIKE' => '%' . $q . '%'
                )
            );
        }

        $this->set(array('q' => $q, 'list' => $this->Paginator->paginate('CourseCategory', $where)));
        $this->loadCombos();
    }

    public function add()
    {

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->CourseCategory->create();
            if ($this->CourseCategory->saveAll($this->request->data, array('DEEP' => TRUE))) {
                $this->Session->setFlash('A categoria foi cadastrada com sucesso!', 'success');
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

            $this->CourseCategory->id = $id;
            if ($this->CourseCategory->saveAll($this->request->data, array('DEEP' => TRUE))) {
                $this->Session->setFlash('A categoria foi atualizada com sucesso!', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
            }
        } else {
            $this->request->data = $this->CourseCategory->findById($id);
        }

        $this->set(compact('id'));

        $this->loadCombos();
    }

    public function view($id = NULL)
    {
        if (!$this->CourseCategory->exists($id)) {
            $this->Session->setFlash('A categoria não pode ser encontrada.', 'warning');
            $this->redirect(array('action' => 'index'));
        }

        $this->request->data = $this->CourseCategory->find('first', array(
            'conditions' => 'CourseCategory.id = ' . $id
        ));

        $this->set(compact('id'));

        $this->loadCombos();
    }

    public function remove($id = NULL)
    {
        if (empty($id) || !$this->CourseCategory->exists($id))
            $this->redirect(array('action' => 'index'));

        $this->CourseCategory->id = $id;
        if ($this->CourseCategory->delete($id, FALSE)) {
            $this->Session->setFlash('A categoria foi removida com sucesso.', 'success');
        } else {
            $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
        }

        $this->redirect(array('action' => 'index'));
    }

    private function loadCombos()
    {
    }
}