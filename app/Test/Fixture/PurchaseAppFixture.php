<?php
/**
 * PurchaseAppFixture
 *
 */
class PurchaseAppFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'code_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'purchased_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'expired_date' => array('type' => 'timestamp', 'null' => true, 'default' => '0000-00-00 00:00:00'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'code_id' => 1,
			'purchased_date' => 1447905487,
			'expired_date' => 1447905487
		),
	);

}
