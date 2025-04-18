<?php
/**
 * LogtimeFixture
 *
 */
class LogtimeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'logtime' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'os' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '0: ios
1: android
2: web'),
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
			'logtime' => 1,
			'os' => 1
		),
	);

}
