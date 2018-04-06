<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    public $actsAs = array('Containable');

    //get current logged-in user
    public function getCurrentUser() {
        App::uses('CakeSession', 'Model/Datasource');
        $Session = new CakeSession();
        $user = $Session->read('Auth.User');
        return $user['id'];
    }

    //populate created_by and modified_by
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        //find all fields from table created_by/modified_by exists
        $fields = array_keys($this->getColumnTypes());

        //get modal name to feed in data in appropriate array key
        $modal = array_keys($this->data);
        $modal = $modal[0];

        //add created_by value
        if(in_array('created_by', $fields) && !isset($this->data[$modal]['id'])){
            //correct this line
            $this->data[$modal]['created_by'] = $this->getCurrentUser()==null?-1:$this->getCurrentUser();
            return true;
        }elseif(in_array('modified_by', $fields)){
            $this->data[$modal]['modified_by'] = $this->getCurrentUser()==null?-1:$this->getCurrentUser();
            return true;
        }
        return true;
    }
}