<?php
App::uses('AppModel', 'Model');

class Sale extends AppModel
{
    public $validate = array();

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'course_id'
        ),
    );
}
