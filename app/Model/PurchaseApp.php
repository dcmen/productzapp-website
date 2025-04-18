<?php
App::uses('AppModel', 'Model');
/**
 * PurchaseApp Model
 *
 * @property User $User
 * @property Code $Code
 */
class PurchaseApp extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RedeemCode' => array(
			'className' => 'RedeemCode',
			'foreignKey' => 'redeem_code_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
