<?php
App::uses('OptionPaypal', 'Model');

/**
 * OptionPaypal Test Case
 *
 */
class OptionPaypalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.option_paypal'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OptionPaypal = ClassRegistry::init('OptionPaypal');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OptionPaypal);

		parent::tearDown();
	}

}
