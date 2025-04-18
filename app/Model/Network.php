<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('SessionComponent', 'Controller/Component');

class Network extends AppModel {
    
    var $name = 'Network';
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'member_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
