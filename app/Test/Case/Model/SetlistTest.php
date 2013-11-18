<?php
App::uses('Setlist', 'Model');

class SetlistTest extends CakeTestCase {
	public $fixtures = array('app.setlist', 'app.track');
	
	public function setUp() {
		parent::setUp();
		$this->Setlist = ClassRegistry::init('Setlist');
	}
	
	public function testCalculateAverageBPM() {
		$trackGroupA = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => 1),
			'recursive' => 1));
		$trackGroupB = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => 2),
			'recursive' => 1));
		$trackGroupC = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => 3),
			'recursive' => 1));
		$trackGroupD = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => 4),
			'recursive' => 1));
		$trackGroupF = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => 6),
			'recursive' => 1));
			
		debug($trackGroupA);
		debug($trackGroupF);
			
		$this->assertEquals(140, $this->Setlist->calculateAverageBPM($trackGroupA['Track']));
		$this->assertEquals(179, $this->Setlist->calculateAverageBPM($trackGroupB['Track']));
		$this->assertEquals(147, $this->Setlist->calculateAverageBPM($trackGroupC['Track']));
		$this->assertEquals(0, $this->Setlist->calculateAverageBPM($trackGroupD['Track']));
		$this->assertEquals(141, $this->Setlist->calculateAverageBPM($trackGroupF['Track']));
		$this->assertEquals(0, $this->Setlist->calculateAverageBPM());
	}
	
	public function testBSConvertBPMStorable() {
		$method = new ReflectionMethod('Setlist', 'bsConvertBPMStorable');
		$method->setAccessible(true);
		
		$this->assertEquals(100, $method->invoke(new Setlist(), 1));
		$this->assertEquals(57300, $method->invoke(new Setlist(), 573));
		$this->assertEquals(12345, $method->invoke(new Setlist(), 123.45));
		$this->assertEquals(14050, $method->invoke(new Setlist(), 140.5));
	}
}
?>