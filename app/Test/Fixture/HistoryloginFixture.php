<?php
/**
 * HistoryloginFixture
 *
 */
class HistoryloginFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'time_login' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'time_logout' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'count_view' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'time_login' => 1,
			'time_logout' => 1,
			'count_view' => 1
		),
	);

}
