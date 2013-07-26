<?php
App::uses('Component', 'Controller');
App::uses('UrlhashComponent', 'Controller/Component');

class UrlhashComponentTest extends CakeTestCase {

	public function setUp() {
		parent::setUp();
		$this->UrlhashComponent = new UrlhashComponent();
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->UrlhashComponent);
	}

	public function testEncrypt() {
		$specificHash = $this->UrlhashComponent->encrypt(573);
		$this->assertEquals('', $this->UrlhashComponent->encrypt());	// No ID given
		$this->assertStringMatchesFormat('%s', $specificHash);	// Positive ID given
		$this->assertEquals('', $this->UrlhashComponent->encrypt(-42));	// Negative ID given
		$this->assertStringMatchesFormat('%s', $this->UrlhashComponent->encrypt('573'));	// Numeric string given
		$this->assertEquals('', $this->UrlhashComponent->encrypt('fiveseventhree'));	// Text string given
	}
	
	/**
	 * @depends testEncrypt
	 */

	public function testDecrypt() {
		$specificHash = $this->UrlhashComponent->encrypt(573);
		$this->assertEquals('573', $this->UrlhashComponent->decrypt($specificHash));	// Valid hash given
		$this->assertEquals('', $this->UrlhashComponent->decrypt('NotValid!'));	// Invalid hash given
		$this->assertEquals('', $this->UrlhashComponent->decrypt());	// No hash given
	}
}
?>