<?php
App::uses('OtherNotification', 'Model');

/**
 * OtherNotification Test Case
 *
 */
class OtherNotificationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.other_notification',
		'app.notification',
		'app.user',
		'app.role',
		'app.appchat',
		'app.block',
		'app.comment',
		'app.customer',
		'app.setandforget',
		'app.followed_car',
		'app.car',
		'app.conversation',
		'app.history_transaction',
		'app.image',
		'app.transfer',
		'app.message',
		'app.network',
		'app.notification_setting',
		'app.push_notification_registration',
		'app.read_mark',
		'app.share_setandforget',
		'app.subscription',
		'app.sender'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OtherNotification = ClassRegistry::init('OtherNotification');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OtherNotification);

		parent::tearDown();
	}

}
