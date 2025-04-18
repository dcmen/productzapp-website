<?php
App::uses('DataSourceCar', 'Model');

/**
 * DataSourceCar Test Case
 *
 */
class DataSourceCarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_source_car'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DataSourceCar = ClassRegistry::init('DataSourceCar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DataSourceCar);

		parent::tearDown();
	}

}
