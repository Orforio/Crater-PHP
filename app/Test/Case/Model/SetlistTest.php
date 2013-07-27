<?php
App::uses('Setlist', 'Model');

class SetlistTest extends CakeTestCase {
	public $fixtures = array('app.setlist', 'app.track');
	
	public function setUp() {
		parent::setUp();
		$this->Setlist = ClassRegistry::init('Setlist');
	}
	
	public function testCalculateAverageBPM() {
		$trackGroupA = $this->Setlist->Track->find('all', array(
			'conditions' => array('Track.setlist_id' => 1)));
		$trackGroupB = $this->Setlist->Track->find('all', array(
			'conditions' => array('Track.setlist_id' => 2)));
		$trackGroupC = $this->Setlist->Track->find('all', array(
			'conditions' => array('Track.setlist_id' => 3)));
		$trackGroupD = $this->Setlist->Track->find('all', array(
			'conditions' => array('Track.setlist_id' => 4)));
			
			debug($trackGroupA);
			
		$this->assertEquals(140, $this->Setlist->calculateAverageBPM($trackGroupA));
		$this->assertEquals(179, $this->Setlist->calculateAverageBPM($trackGroupB));
		$this->assertEquals(147, $this->Setlist->calculateAverageBPM($trackGroupC));
		$this->assertEquals(0, $this->Setlist->calculateAverageBPM($trackGroupD));
	}
}
?>