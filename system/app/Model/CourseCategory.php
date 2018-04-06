<?php
App::uses('AppModel', 'Model');

class CourseCategory extends AppModel
{
    public $validate = array(
//        'name' => array(
//            'notempty',
//        )
    );

    public $hasMany = array(
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'course_category_id'
        ),
    );
}