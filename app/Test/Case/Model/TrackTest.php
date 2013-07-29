<?php
App::uses('Setlist', 'Model');
App::uses('Track', 'Model');

class TrackTest extends CakeTestCase {
	public $fixtures = array('app.setlist', 'app.track');
	
	public function setUp() {
		parent::setUp();
		$this->Setlist = ClassRegistry::init('Setlist');
		$this->Track = ClassRegistry::init('Track');
	}
	
	public function testCalculateBPMDifference() {
		$trackGroupBMasterBPM = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => 2),
			'fields' => array('Setlist.master_bpm')));
		$trackGroupBMasterBPM = $trackGroupBMasterBPM['Setlist']['master_bpm'];
		
		$trackGroupB = $this->Track->find('all', array(
			'conditions' => array('Track.setlist_id' => 2)));
			
		debug($trackGroupB);
		debug($trackGroupBMasterBPM);
		debug($this->Track->calculateBPMDifference($trackGroupB, $trackGroupBMasterBPM));
		
		$modifiedTrackGroupB = $this->Track->calculateBPMDifference($trackGroupB, $trackGroupBMasterBPM);
		
		$this->assertArrayHasKey('bpm_difference', $modifiedTrackGroupB[0]['Track']);
		$this->assertEquals(0, $modifiedTrackGroupB[0]['Track']['bpm_difference']);
		$this->assertEquals(-5.56, $modifiedTrackGroupB[1]['Track']['bpm_difference']);		
	}
}
?>