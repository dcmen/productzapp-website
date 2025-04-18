<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.role',
		'app.invited_by',
		'app.appchat',
		'app.block',
		'app.comment',
		'app.customer',
		'app.followed_car',
		'app.message',
		'app.network',
		'app.notification_setting',
		'app.push_notification_registration',
		'app.read_mark',
		'app.setandforget',
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
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
