<?php
App::uses('Key', 'Model');

/**
 * Key Test Case
 *
 */
class KeyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.key',
		'app.track',
		'app.setlist'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Key = ClassRegistry::init('Key');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Key);

		parent::tearDown();
	}

/**
 * testCalculateKeyDifference method
 *
 * @return void
 */
	public function testDoNothing() {
		return true;
	}

}
?>