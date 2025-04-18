<?php
App::uses('Historylogin', 'Model');

/**
 * Historylogin Test Case
 *
 */
class HistoryloginTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historylogin'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historylogin = ClassRegistry::init('Historylogin');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historylogin);

		parent::tearDown();
	}

}
