<?php
App::uses('AppModel', 'Model');

class Course extends AppModel
{
    public $validate = array(
//        'name' => array(
//            'notempty',
//        )
    );

    public $belongsTo = array(
        'CourseCategory' => array(
            'className' => 'CourseCategory',
            'foreignKey' => 'course_category_id'
        )
    );

    public $hasMany = array(
        'Sale' => array(
            'className' => 'Sale',
            'foreignKey' => 'course_id'
        )
    );
}