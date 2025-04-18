<?php
App::uses('AppModel', 'Model');
class HistoryTransaction extends AppModel {
    
    var $name = 'HistoryTransaction';
    public $belongsTo = array(
		'Car' => array(
			'className' => 'Car',
			'foreignKey' => 'car_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
