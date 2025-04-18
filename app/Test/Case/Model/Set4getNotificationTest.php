<?php
App::uses('Set4getNotification', 'Model');

/**
 * Set4getNotification Test Case
 *
 */
class Set4getNotificationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.set4get_notification',
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
		'app.historylogin',
		'app.set4get'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Set4getNotification = ClassRegistry::init('Set4getNotification');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Set4getNotification);

		parent::tearDown();
	}

}
