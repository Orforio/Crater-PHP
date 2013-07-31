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
			
		debug($trackGroupA);
			
		$this->assertEquals(140, $this->Setlist->calculateAverageBPM($trackGroupA['Track']));
		$this->assertEquals(179, $this->Setlist->calculateAverageBPM($trackGroupB['Track']));
		$this->assertEquals(147, $this->Setlist->calculateAverageBPM($trackGroupC['Track']));
		$this->assertEquals(0, $this->Setlist->calculateAverageBPM($trackGroupD['Track']));
		$this->assertEquals(0, $this->Setlist->calculateAverageBPM());
	}
}
?>