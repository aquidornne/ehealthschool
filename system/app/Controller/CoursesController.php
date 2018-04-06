<?php
App::uses('AppController', 'Controller');
App::uses('ToolHelper', 'View/Helper');
App::uses('Money2Helper', 'View/Helper');

class CoursesController extends AppController
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
        $this->Paginator->settings = array('order' => array('Course.created' => 'DESC'));

        $q = '';
        $where = array();
        if (isset($this->request->query['q'])) {
            $q = $this->request->query['q'];
            $where = array(
                'OR' => array(
                    'Course.name LIKE' => '%' . $q . '%'
                )
            );
        }

        $this->set(array('q' => $q, 'list' => $this->Paginator->paginate('Course', $where)));
        $this->loadCombos();
    }

    public function add()
    {
        $toolhelper = new ToolHelper(new View());
        $money2helper = new Money2Helper(new View());

        if ($this->request->is('post') || $this->request->is('put')) {
            if (isset($this->request->data['Course']['value']) AND !empty($this->request->data['Course']['value'])) {
                $this->request->data['Course']['value'] = $money2helper->convertDecimal($this->request->data['Course']['value']);
            }

            if (isset($this->request->data['Course']['value']) AND !empty($this->request->data['Course']['value'])) {
                $this->request->data['Course']['value'] = $money2helper->convertDecimal($this->request->data['Course']['value']);
            }

            if (isset($this->request->data['Course']['cover']['name']) AND !empty($this->request->data['Course']['cover']['name'])) {
                $file = $toolhelper->uploadFile($this->request->data['Course']['cover'], 'courses');

                if ($file['success']) {
                    $this->request->data['Course']['cover'] = $file['file'];
                }
            } else {
                $this->request->data['Course']['cover'] = '';
            }

            if (isset($this->request->data['Course']['teachers']) AND !empty($this->request->data['Course']['teachers'])) {
                $this->request->data['Course']['teachers'] = implode(',', $this->request->data['Course']['teachers']);
            }

            $this->Course->create();
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash('O curso foi cadastrado com sucesso!', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
            }
        }

        $this->loadCombos();
    }

    public function edit($id = NULL)
    {
        $toolhelper = new ToolHelper(new View());
        $money2helper = new Money2Helper(new View());

        if ($this->request->is('post') || $this->request->is('put')) {
            if (isset($this->request->data['Course']['value']) AND !empty($this->request->data['Course']['value'])) {
                $this->request->data['Course']['value'] = $money2helper->convertDecimal($this->request->data['Course']['value']);
            }

            if (isset($this->request->data['Course']['cover']['name']) AND !empty($this->request->data['Course']['cover']['name'])) {
                $file = $toolhelper->uploadFile($this->request->data['Course']['cover'], 'courses');

                if ($file['success']) {
                    $this->request->data['Course']['cover'] = $file['file'];
                }
            } else {
                $this->request->data['Course']['cover'] = $this->request->data['Course']['cover_old'];
            }

            if (isset($this->request->data['Course']['teachers']) AND !empty($this->request->data['Course']['teachers'])) {
                $this->request->data['Course']['teachers'] = implode(',', $this->request->data['Course']['teachers']);
            }

            $this->Course->id = $id;
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash('O curso foi atualizado com sucesso!', 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
            }
        } else {
            $this->request->data = $this->Course->findById($id);

            $this->request->data['Course']['value'] = $money2helper->convertReal($this->request->data['Course']['value']);
        }

        $this->set(compact('id'));

        $this->loadCombos();
    }

    public function view($id = NULL)
    {
        if (!$this->Course->exists($id)) {
            $this->Session->setFlash('O curso não pode ser encontrada.', 'warning');
            $this->redirect(array('action' => 'index'));
        }

        $this->request->data = $this->Course->find('first', array(
            'conditions' => 'Course.id = ' . $id
        ));

        $this->set(compact('id'));

        $this->loadCombos();
    }

    public function remove($id = NULL, $cover = NULL)
    {
        if (empty($id) || !$this->Course->exists($id))
            $this->redirect(array('action' => 'index'));

        $this->Course->id = $id;
        if ($this->Course->delete($id, FALSE)) {
            @unlink(unlink(WWW_ROOT . 'files' . '/' . 'courses' . '/' . $cover));

            $this->Session->setFlash('O curso foi removido com sucesso.', 'success');
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Ocorreu algum erro, por favor, tente novamente mais tarde.', 'failure');
        }

        $this->redirect(array('action' => 'index'));
    }

    private function loadCombos()
    {
        $this->loadModel('Teacher');
        $teachers = $this->Teacher->find('all', array('order' => 'Teacher.name ASC'));
        $teachers = Set::combine($teachers, '{n}.Teacher.id', '{n}.Teacher.name');

        $this->loadModel('CourseCategory');
        $coursecategories = $this->CourseCategory->find('all', array('order' => 'CourseCategory.name ASC'));
        $coursecategories = Set::combine($coursecategories, '{n}.CourseCategory.id', '{n}.CourseCategory.name');

        $this->set(compact('teachers', 'coursecategories'));
    }
}