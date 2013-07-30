<?php
App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('TrackHelper', 'View/Helper');

class TrackHelperTest extends CakeTestCase {
	public $Track = null;

	public function setUp() {
		parent::setUp();
		$Controller = new Controller();
		$View = new View($Controller);
		$this->Track = new TrackHelper($View);
    }

	public function testDisplayBPM() {
		$this->assertEquals('', $this->Track->displayBPM());
		$this->assertEquals(' <span class="track-bpm track-bpm-equal">=</span>', $this->Track->displayBPM(0));
		$this->assertEquals(' <span class="track-bpm track-bpm-positive">+2.36%</span>', $this->Track->displayBPM(2.36));
		$this->assertEquals(' <span class="track-bpm track-bpm-negative">-5.00%</span>', $this->Track->displayBPM(-5));
		
		$this->assertEquals('', $this->Track->displayBPM('invalid'));
	}
}
?>