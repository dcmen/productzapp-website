<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('SessionComponent', 'Controller/Component');

class Transfer extends AppModel {
    
    var $name = 'Transfer';
    public $belongsTo = array(
            'User' => array(
                    'className' => 'User',
                    'foreignKey' => 'transfer_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
            ),
            'Car' => array(
                    'className' => 'Car',
                    'foreignKey' => 'car_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
            )
	);
}
