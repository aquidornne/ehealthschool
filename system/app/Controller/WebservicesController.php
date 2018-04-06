<?php

App::uses('AppController', 'Controller');
App::uses('DateHelper', 'View/Helper');
App::uses('CakeEmail', 'Network/Email');
App::uses('Money2Helper', 'View/Helper');

class WebservicesController extends AppController
{
    public function isAuthorized($user)
    {
        return TRUE;
    }

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow();
    }

    public function index()
    {
        $this->layout = 'ajax';
        $this->autoRender = FALSE;

        return json_encode(array('success' => FALSE, 'msg' => "you're doing it wrong!"));
    }

    public function findAddressOfCep()
    {
        $this->autoRender = FALSE;
        $this->layout = 'ajax';

        try {
            $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $this->request->data['cep']);

            $data = array(
                'success' => (string)$reg->resultado,
                'address' => (string)$reg->tipo_logradouro . ' ' . $reg->logradouro,
                'neighborhood' => (string)$reg->bairro,
                'city' => (string)$reg->cidade,
                'state' => (string)$reg->uf
            );
        } catch (Exception $e) {
            $data = array('success' => FALSE, 'street' => '', 'neighborhood' => '', 'city' => '', 'state' => '');
        }

        header("Content-type: application/json");
        echo json_encode($data);
    }

    public function serviceFindCourseByUrl()
    {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('Course');
        $this->loadModel('Teacher');

        if ($this->request->data['clientSecretKey'] == $this->keyServices) {
            $where = array(
                'AND' => array('Course.url' => $this->request->data['url'])
            );

            $data = array();

            $data_course = $this->Course->find('first', array(
                'limit' => ((isset($this->request->data['limit']) AND $this->request->data['limit'] != NULL) ? $this->request->data['limit'] : 30),
                'conditions' => $where,
                'order' => array('Course.created' => 'DESC')
            ));

            if (!empty($data_course)) {
                $data_teachers = $this->Teacher->find('all', array(
                    'conditions' => array(
                        'AND' => array('Teacher.id' => explode(',', $data_course['Course']['teachers']))
                    )
                ));

                $data['Course'] = $data_course['Course'];
                $data['Teacher'] = $data_teachers;
            }

            header("Content-type: application/json");
            echo json_encode(array('success' => true, 'msgError' => 'Sucesso', 'data' => $data));
            exit;
        } else {
            header("Content-type: application/json");
            echo json_encode(array('success' => false, 'msgError' => 'Error!'));
            exit;
        }
    }

    public function serviceFindAllCourse()
    {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('Course');

        if ($this->request->data['clientSecretKey'] == $this->keyServices) {
            $page = ((isset($this->request->data['page']) AND $this->request->data['page'] != NULL) ? $this->request->data['page'] : 1);

            $where = array();

            $this->request->data = $this->Course->find('all', array(
                'limit' => ((isset($this->request->data['limit']) AND $this->request->data['limit'] != NULL) ? $this->request->data['limit'] : 30),
                'page' => $page,
                'conditions' => $where,
                'order' => array('Course.created' => 'DESC')
            ));

            $data_count = $this->Course->find('count', array(
                'conditions' => $where
            ));

            $numbers = ceil(($data_count / ((isset($this->request->data['limit']) AND $this->request->data['limit'] != NULL) ? $this->request->data['limit'] : 30)));

            header("Content-type: application/json");
            echo json_encode(array('success' => true, 'msgError' => 'Sucesso', 'data' => $this->request->data, 'numbers' => $numbers, 'page' => $page));
            exit;
        } else {
            header("Content-type: application/json");
            echo json_encode(array('success' => false, 'msgError' => 'Error!'));
            exit;
        }
    }

    public function serviceFindUserByCpf()
    {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('User');

        if ($this->request->data['clientSecretKey'] == $this->keyServices) {
            $where = array(
                'AND' => array('User.cpf' => $this->request->data['cpf'])
            );

            $this->request->data = $this->User->find('first', array(
                'limit' => ((isset($this->request->data['limit']) AND $this->request->data['limit'] != NULL) ? $this->request->data['limit'] : 30),
                'conditions' => $where,
                'order' => array('User.created' => 'DESC')
            ));

            header("Content-type: application/json");
            echo json_encode(array('success' => true, 'msgError' => 'Sucesso', 'data' => $this->request->data));
            exit;
        } else {
            header("Content-type: application/json");
            echo json_encode(array('success' => false, 'msgError' => 'Error!'));
            exit;
        }
    }

    public function serviceFindSale()
    {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('Sale');

        if ($this->request->data['clientSecretKey'] == $this->keyServices) {
            $where = array(
                'AND' => array('mp_code' => $this->request->data['mp_code'])
            );

            $this->request->data = $this->Sale->find('first', array(
                'conditions' => $where,
                'order' => array('Sale.created' => 'DESC'),
            ));

            header("Content-type: application/json");
            echo json_encode(array('success' => true, 'msgError' => 'Sucesso', 'data' => $this->request->data));
            exit;
        } else {
            header("Content-type: application/json");
            echo json_encode(array('success' => false, 'msgError' => 'Error!'));
            exit;
        }
    }

    public function serviceSaveUser()
    {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('User');

        if ($this->request->data['clientSecretKey'] == $this->keyServices) {
            if ($this->User->save($this->request->data)) {
                header("Content-type: application/json");
                return TRUE;
            } else {
                header("Content-type: application/json");
                return FALSE;
            }
            #- -------------------------------------------------------------------------------------------------------------
        } else {
            header("Content-type: application/json");
            return FALSE;
        }
    }

    public function serviceSaveSale()
    {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('Sale');

        $datehelper = new DateHelper(new View());

        if ($this->request->data['clientSecretKey'] == $this->keyServices) {
            if (isset($this->request->data['User']['birth']) AND !empty($this->request->data['User']['birth'])) {
                $this->request->data['User']['birth'] = $datehelper->formatDate($this->request->data['User']['birth'], 'us');
            }

            if ($this->Sale->saveAll($this->request->data, array('DEEP' => TRUE))) {
                header("Content-type: application/json");
                return TRUE;
            } else {
                header("Content-type: application/json");
                return FALSE;
            }
            #- -------------------------------------------------------------------------------------------------------------
        } else {
            header("Content-type: application/json");
            return FALSE;
        }
    }

    public function serviceFindBanners()
    {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('Banner');

        if ($this->request->data['clientSecretKey'] == $this->keyServices):
            $where = array(
                'AND' => array('Banner.is_mobile' => $this->request->data['is_mobile'])
            );

            $this->request->data = $this->Banner->find('all', array(
                'conditions' => $where,
                'order' => array('Banner.created' => 'DESC')
            ));

            header("Content-type: application/json");
            echo json_encode(array('success' => true, 'msgError' => 'Sucesso', 'data' => $this->request->data));
            exit;
        else:
            header("Content-type: application/json");
            echo json_encode(array('success' => false, 'msgError' => 'Error!'));
            exit;
        endif;
    }

    public function serviceSaveNewsletters()
    {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('Newsletter');

        if ($this->request->data['clientSecretKey'] == $this->keyServices) {
            if ($this->Newsletter->save($this->request->data)) {
                header("Content-type: application/json");
                return TRUE;
            } else {
                header("Content-type: application/json");
                return FALSE;
            }
            #- -------------------------------------------------------------------------------------------------------------
        } else {
            header("Content-type: application/json");
            return FALSE;
        }
    }

    public function serviceLogin()
    {
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('User');

        if ($this->request->data['clientSecretKey'] == $this->keyServices) {
            $this->request->data = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $this->request->data['User']['email'],
                    'User.password_2' => $this->request->data['User']['password'],
                    'User.role_id' => 2
                ),
                'contain' => FALSE
            ));

            if (isset($this->request->data) AND !empty($this->request->data)) {
                header("Content-type: application/json");
                echo json_encode(array('success' => true, 'msgError' => 'Sucesso', 'data' => $this->request->data));
                exit;
            } else {
                header("Content-type: application/json");
                echo json_encode(array('success' => false, 'msgError' => 'Error!'));
                exit;
            }
        } else {
            header("Content-type: application/json");
            echo json_encode(array('success' => false, 'msgError' => 'Error!'));
            exit;
        }
    }
}