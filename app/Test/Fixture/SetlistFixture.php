<?php
class SetlistFixture extends CakeTestFixture {
	public $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true),
		'author' => array('type' => 'string', 'null' => true),
		'genre' => array('type' => 'string', 'null' => true),
		'modified' => 'timestamp',
		'private_key' => array('type' => 'string', 'null' => true),	// This will change
		'master_bpm' => array('type' => 'float', 'length' => '5,2', 'null' => true)	// DB Schema actually uses DECIMAL but CakePHP doesn't understand that yet
	);
      
	public $records = array(
		array('id' => 1, 'name' => 'Sunset Trance I: Beachline Expressway', 'author' => 'TGGR.EXE', 'genre' => 'Trance', 'modified' => '2013-07-27 01:27:04', 'private_key' => '', 'master_bpm' => '140.00'),
		array('id' => 2, 'name' => 'Trancemission III', 'author' => 'PkerUNO', 'genre' => 'Trance', 'modified' => '2013-07-27 01:27:04', 'private_key' => '', 'master_bpm' => '180.00'),
		array('id' => 3, 'name' => 'Bemix', 'author' => 'DJ Konami', 'genre' => 'Beatmania', 'modified' => '2013-07-27 01:27:04', 'private_key' => '', 'master_bpm' => ''),
		array('id' => 4, 'name' => 'House Party', 'author' => 'Noel', 'genre' => 'House', 'modified' => '2013-07-27 01:27:04', 'private_key' => '', 'master_bpm' => ''),
		array('id' => 5, 'name' => 'Hardcore Heaven', 'author' => '.59', 'genre' => 'Hardcore', 'modified' => '2013-07-27 01:27:04', 'private_key' => '', 'master_bpm' => '162.00'),
		array('id' => 6, 'name' => 'Weird BPM', 'author' => 'だれか', 'genre' => 'Wobblycore', 'modified' => '2013-07-27 01:27:04', 'private_key' => '', 'master_bpm' => '141.26'),
		array('id' => 7, 'name' => 'Wrong Order', 'author' => 'Blue Mondays', 'genre' => 'Easy Listing', 'modified' => '2013-07-27 01:27:04', 'private_key' => '', 'master_bpm' => '100.00')
	);
}
?>