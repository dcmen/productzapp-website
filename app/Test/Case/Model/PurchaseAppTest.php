<?php
App::uses('PurchaseApp', 'Model');

/**
 * PurchaseApp Test Case
 *
 */
class PurchaseAppTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.purchase_app',
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
		'app.code'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PurchaseApp = ClassRegistry::init('PurchaseApp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PurchaseApp);

		parent::tearDown();
	}

}
