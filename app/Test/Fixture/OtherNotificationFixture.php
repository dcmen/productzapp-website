<?php
/**
 * OtherNotificationFixture
 *
 */
class OtherNotificationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'notification_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'car_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'sender_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'is_read' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'created_at' => array('type' => 'timestamp', 'null' => true),
		'message' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'notification_id' => 1,
			'user_id' => 1,
			'car_id' => 1,
			'sender_id' => 1,
			'is_read' => 1,
			'created_at' => 1447644793,
			'message' => 'Lorem ipsum dolor sit amet'
		),
	);

}
