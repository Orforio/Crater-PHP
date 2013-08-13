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
	
	public function testGetKeyNotation() {
		$this->assertEquals('B', $this->Track->getKeyNotation('1B'));
		$this->assertEquals('A♭', $this->Track->getKeyNotation('4B'));
		$this->assertEquals('F♯m', $this->Track->getKeyNotation('11A'));
		$this->assertEquals('E', $this->Track->getKeyNotation('12b'));	// Lowercase letter
		$this->assertEquals('', $this->Track->getKeyNotation());
	}
	
	public function testGetKeyCode() {
		$this->assertEquals('2A', $this->Track->getKeyCode('Ebm'));
		$this->assertEquals('2B', $this->Track->getKeyCode('F#'));
		$this->assertEquals('6B', $this->Track->getKeyCode('b♭'));
		$this->assertEquals('10A', $this->Track->getKeyCode('bM'));
		$this->assertEquals('', $this->Track->getKeyCode());
	}
	
	public function testCalculateBPMDifference() {
		$trackGroupB = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => 2),
			'recursive' => 1));
			
		debug($trackGroupB);
		
		$testTrackArray0 = $this->Track->calculateBPMDifference($trackGroupB['Track'][0], $trackGroupB['Setlist']['master_bpm']);
		$testTrackArray1 = $this->Track->calculateBPMDifference($trackGroupB['Track'][1], $trackGroupB['Setlist']['master_bpm']);
		$testTrackArray4 = $this->Track->calculateBPMDifference($trackGroupB['Track'][4], $trackGroupB['Setlist']['master_bpm']);
		
		$this->assertArrayHasKey('bpm_difference', $testTrackArray0);
		$this->assertEquals(0, $testTrackArray0['bpm_difference']);		// 180 -> 180 BPM
		$this->assertEquals(5.88, $testTrackArray1['bpm_difference']);	// 170 -> 180 BPM
		$this->assertEquals(-2.17, $testTrackArray4['bpm_difference']);	// 184 -> 180 BPM
	}
	
	/**
	 * @depends testCalculateBPMDifference
	 */
	
	public function testCalculateKeyDifference() {
		$trackGroupE = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => 5),
			'recursive' => 1));
			
		debug($trackGroupE);
		
		$testTrackArray0 = $this->Track->calculateBPMDifference($trackGroupE['Track'][0], $trackGroupE['Setlist']['master_bpm']);
		$testTrackArray0 = $this->Track->calculateKeyDifference($testTrackArray0);
		
		$testTrackArray1 = $this->Track->calculateBPMDifference($trackGroupE['Track'][1], $trackGroupE['Setlist']['master_bpm']);
		$testTrackArray1 = $this->Track->calculateKeyDifference($testTrackArray1);
		
		$testTrackArray2 = $this->Track->calculateBPMDifference($trackGroupE['Track'][2], $trackGroupE['Setlist']['master_bpm']);
		$testTrackArray2 = $this->Track->calculateKeyDifference($testTrackArray2);
		
		$testTrackArray3 = $this->Track->calculateBPMDifference($trackGroupE['Track'][3], $trackGroupE['Setlist']['master_bpm']);
		$testTrackArray3 = $this->Track->calculateKeyDifference($testTrackArray3);
		
		$testTrackArray4 = $this->Track->calculateBPMDifference($trackGroupE['Track'][4], $trackGroupE['Setlist']['master_bpm']);
		$testTrackArray4 = $this->Track->calculateKeyDifference($testTrackArray4);
		
		$testTrackArray5 = $this->Track->calculateBPMDifference($trackGroupE['Track'][5], $trackGroupE['Setlist']['master_bpm']);
		$testTrackArray5 = $this->Track->calculateKeyDifference($testTrackArray5);
		
		$testTrackArray6 = $this->Track->calculateBPMDifference($trackGroupE['Track'][6], $trackGroupE['Setlist']['master_bpm']);
		$testTrackArray6 = $this->Track->calculateKeyDifference($testTrackArray6);

		debug($testTrackArray5);
		
		$this->assertArrayHasKey('key_start_modified', $testTrackArray0);
		$this->assertEquals('10A', $testTrackArray0['key_start_modified']);	// 156 -> 162 BPM, one tone higher
		$this->assertEquals('5B', $testTrackArray1['key_start_modified']);	// 161 -> 162 BPM, no change
		$this->assertEquals('7A', $testTrackArray2['key_start_modified']);	// 162 -> 162 BPM, no change
		$this->assertEquals('2B', $testTrackArray3['key_start_modified']);	// 168 -> 162 BPM, one tone lower
		$this->assertEquals('9A', $testTrackArray4['key_start_modified']);	// 180 -> 162 BPM, two tones lower
		$this->assertEquals('', $testTrackArray5['key_start_modified']);	// No BPM given, empty result
		$this->assertEquals('', $this->Track->calculateKeyDifference());	// Invalid input, empty result
		$this->assertEquals('1B', $testTrackArray6['key_start_modified']);	// Test wrap-around issue
	}
}
?>