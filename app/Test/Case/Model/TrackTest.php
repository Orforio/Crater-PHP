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
		$trackGroupB = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => 2),
			'recursive' => 1));
		// $trackGroupBMasterBPM = $trackGroupBMasterBPM['Setlist']['master_bpm'];
		
		/*
		$trackGroupB = $this->Track->find('all', array(
			'conditions' => array('Track.setlist_id' => 2))); */
			
		debug($trackGroupB);
		
		// $modifiedTrackGroupB = $this->Track->calculateBPMDifference($trackGroupB, $trackGroupBMasterBPM);
		
		$testTrackArray0 = $this->Track->calculateBPMDifference($trackGroupB['Track'][0], $trackGroupB['Setlist']['master_bpm']);
		$testTrackArray1 = $this->Track->calculateBPMDifference($trackGroupB['Track'][1], $trackGroupB['Setlist']['master_bpm']);
		
		$this->assertArrayHasKey('bpm_difference', $testTrackArray0);
		$this->assertEquals(0, $testTrackArray0['bpm_difference']);
		$this->assertEquals(-5.56, $testTrackArray1['bpm_difference']);		
	}
}
?>