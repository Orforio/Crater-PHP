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
	
	public function testDisplayKey() {
		$this->assertEquals('', $this->Track->displayKey());
		$this->assertEquals('<span class="track-key track-key-good">4A</span>', $this->Track->displayKey(0, "4A"));
		$this->assertEquals('<span class="track-key track-key-borderline">11B</span>', $this->Track->displayKey(2.36, "11B"));
		$this->assertEquals('<span class="track-key track-key-bad">7A</span>', $this->Track->displayKey(-3.18, "7A"));
		$this->assertEquals('<span class="track-key track-key-good">9B</span>', $this->Track->displayKey(-5, "9B"));
		$this->assertEquals('', $this->Track->displayKey('invalid'));
	}
}
?>