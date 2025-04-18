<?php
App::uses('Logtime', 'Model');

/**
 * Logtime Test Case
 *
 */
class LogtimeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.logtime',
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
		'app.subscription'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Logtime = ClassRegistry::init('Logtime');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Logtime);

		parent::tearDown();
	}

}
