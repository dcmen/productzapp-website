<?php
App::uses('AppModel', 'Model');
class InviteNetwork extends AppModel {
  
    var $name = 'InviteNetwork';
    public $belongsTo = array(
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'sender_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
        )
    );
}
