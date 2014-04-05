<?php
class TrackFixture extends CakeTestFixture {
	public $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'setlist_id' => array('type' => 'integer', 'null' => false),
		'setlist_order' => array('type' => 'integer', 'length' => 3, 'null' => false),
		'title' => array('type' => 'string', 'null' => false),
		'artist' => array('type' => 'string', 'null' => true),
		'label' => array('type' => 'string', 'null' => true),
		'length' => array('type' => 'time', 'null' => true),
		'bpm_start' => array('type' => 'float', 'length' => '5,2', 'null' => true),	// Actual DB uses DECIMAL
		'bpm_end' => array('type' => 'float', 'length' => '5,2', 'null' => true),	// Actual DB uses DECIMAL
		'key_start' => array('type' => 'integer', 'length' => 2, 'null' => true),
		'key_end' => array('type' => 'integer', 'length' => 2, 'null' => true)
	);
      
	public $records = array(
		array('id' => 1, 'setlist_id' => '1', 'setlist_order' => '1', 'title' => 'Track A', 'artist' => 'Artist A', 'label' => 'Label A', 'length' => '00:01:23', 'bpm_start' => '140.00', 'bpm_end' => '', 'key_start' => '5', 'key_end' => ''),
		array('id' => 2, 'setlist_id' => '1', 'setlist_order' => '2', 'title' => 'Track B', 'artist' => 'Artist B', 'label' => 'Label B', 'length' => '00:02:34', 'bpm_start' => '138.00', 'bpm_end' => '', 'key_start' => '22', 'key_end' => ''),
		array('id' => 3, 'setlist_id' => '1', 'setlist_order' => '3', 'title' => 'Track C', 'artist' => 'Artist C', 'label' => 'Label C', 'length' => '00:01:23', 'bpm_start' => '142.00', 'bpm_end' => '', 'key_start' => '6', 'key_end' => ''),
		array('id' => 4, 'setlist_id' => '1', 'setlist_order' => '4', 'title' => 'Track D', 'artist' => 'Artist D', 'label' => 'Label D', 'length' => '00:01:23', 'bpm_start' => '140.00', 'bpm_end' => '', 'key_start' => '12', 'key_end' => ''),
		array('id' => 5, 'setlist_id' => '1', 'setlist_order' => '5', 'title' => 'Track E', 'artist' => 'Artist E', 'label' => 'Label E', 'length' => '00:01:23', 'bpm_start' => '140.00', 'bpm_end' => '', 'key_start' => '11', 'key_end' => ''),
		array('id' => 6, 'setlist_id' => '2', 'setlist_order' => '1', 'title' => 'Track F', 'artist' => 'Artist F', 'label' => 'Label F', 'length' => '00:01:23', 'bpm_start' => '180.00', 'bpm_end' => '', 'key_start' => '1', 'key_end' => ''),
		array('id' => 7, 'setlist_id' => '2', 'setlist_order' => '2', 'title' => 'Track G', 'artist' => 'Artist G', 'label' => 'Label G', 'length' => '00:01:23', 'bpm_start' => '170.00', 'bpm_end' => '', 'key_start' => '3', 'key_end' => ''),
		array('id' => 8, 'setlist_id' => '2', 'setlist_order' => '3', 'title' => 'Track H', 'artist' => 'Artist H', 'label' => 'Label H', 'length' => '00:01:23', 'bpm_start' => '178.00', 'bpm_end' => '', 'key_start' => '4', 'key_end' => ''),
		array('id' => 9, 'setlist_id' => '2', 'setlist_order' => '4', 'title' => 'Track I', 'artist' => 'Artist I', 'label' => 'Label I', 'length' => '00:01:23', 'bpm_start' => '182.00', 'bpm_end' => '', 'key_start' => '6', 'key_end' => ''),
		array('id' => 10, 'setlist_id' => '2', 'setlist_order' => '5', 'title' => 'Track J', 'artist' => 'Artist J', 'label' => 'Label J', 'length' => '00:01:23', 'bpm_start' => '184.00', 'bpm_end' => '', 'key_start' => '4B', 'key_end' => ''),
		array('id' => 11, 'setlist_id' => '3', 'setlist_order' => '1', 'title' => 'Track K', 'artist' => 'Artist K', 'label' => 'Label K', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '23', 'key_end' => ''),
		array('id' => 12, 'setlist_id' => '3', 'setlist_order' => '2', 'title' => 'Track L', 'artist' => 'Artist L', 'label' => 'Label L', 'length' => '00:01:23', 'bpm_start' => '150.00', 'bpm_end' => '', 'key_start' => '11', 'key_end' => ''),
		array('id' => 13, 'setlist_id' => '3', 'setlist_order' => '3', 'title' => 'Track M', 'artist' => 'Artist M', 'label' => 'Label M', 'length' => '00:01:23', 'bpm_start' => '142.00', 'bpm_end' => '', 'key_start' => '12', 'key_end' => ''),
		array('id' => 14, 'setlist_id' => '3', 'setlist_order' => '4', 'title' => 'Track N', 'artist' => 'Artist N', 'label' => 'Label N', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '37B', 'key_end' => ''),
		array('id' => 15, 'setlist_id' => '3', 'setlist_order' => '5', 'title' => 'Track O', 'artist' => 'Artist O', 'label' => 'Label O', 'length' => '00:01:23', 'bpm_start' => '148.00', 'bpm_end' => '', 'key_start' => '3', 'key_end' => ''),
		array('id' => 16, 'setlist_id' => '4', 'setlist_order' => '1', 'title' => 'Track P', 'artist' => 'Artist P', 'label' => 'Label P', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '5', 'key_end' => ''),
		array('id' => 17, 'setlist_id' => '4', 'setlist_order' => '2', 'title' => 'Track Q', 'artist' => 'Artist Q', 'label' => 'Label Q', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '5', 'key_end' => ''),
		array('id' => 18, 'setlist_id' => '4', 'setlist_order' => '3', 'title' => 'Track R', 'artist' => 'Artist R', 'label' => 'Label R', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '5', 'key_end' => ''),
		array('id' => 19, 'setlist_id' => '4', 'setlist_order' => '4', 'title' => 'Track S', 'artist' => 'Artist S', 'label' => 'Label S', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '5', 'key_end' => ''),
		array('id' => 20, 'setlist_id' => '4', 'setlist_order' => '5', 'title' => 'Track T', 'artist' => 'Artist T', 'label' => 'Label T', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '5', 'key_end' => ''),
		array('id' => 21, 'setlist_id' => '5', 'setlist_order' => '1', 'title' => 'Track U', 'artist' => 'Artist U', 'label' => 'Label U', 'length' => '00:01:23', 'bpm_start' => '156.00', 'bpm_end' => '', 'key_start' => '5', 'key_end' => ''),
		array('id' => 22, 'setlist_id' => '5', 'setlist_order' => '2', 'title' => 'Track V', 'artist' => 'Artist V', 'label' => 'Label V', 'length' => '00:01:23', 'bpm_start' => '161.00', 'bpm_end' => '', 'key_start' => '10', 'key_end' => ''),
		array('id' => 23, 'setlist_id' => '5', 'setlist_order' => '3', 'title' => 'Track W', 'artist' => 'Artist W', 'label' => 'Label W', 'length' => '00:01:23', 'bpm_start' => '162.00', 'bpm_end' => '', 'key_start' => '13', 'key_end' => ''),
		array('id' => 24, 'setlist_id' => '5', 'setlist_order' => '4', 'title' => 'Track X', 'artist' => 'Artist X', 'label' => 'Label X', 'length' => '00:01:23', 'bpm_start' => '168.00', 'bpm_end' => '', 'key_start' => '18', 'key_end' => ''),
		array('id' => 25, 'setlist_id' => '5', 'setlist_order' => '5', 'title' => 'Track Y', 'artist' => 'Artist Y', 'label' => 'Label Y', 'length' => '00:01:23', 'bpm_start' => '180.00', 'bpm_end' => '', 'key_start' => '21', 'key_end' => ''),
		array('id' => 26, 'setlist_id' => '5', 'setlist_order' => '6', 'title' => 'Track Z', 'artist' => 'Artist Z', 'label' => 'Label Z', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '10', 'key_end' => ''),
		array('id' => 27, 'setlist_id' => '5', 'setlist_order' => '7', 'title' => 'Track ZZ', 'artist' => 'Artist ZZ', 'label' => 'Label ZZ', 'length' => '00:01:23', 'bpm_start' => '148.00', 'bpm_end' => '', 'key_start' => '22', 'key_end' => ''),
		array('id' => 28, 'setlist_id' => '6', 'setlist_order' => '1', 'title' => 'Weird BPM', 'artist' => 'Artist 1', 'label' => 'Label 1', 'length' => '00:01:23', 'bpm_start' => '140.25', 'bpm_end' => '', 'key_start' => '9', 'key_end' => ''),
		array('id' => 29, 'setlist_id' => '6', 'setlist_order' => '2', 'title' => 'Weird BPM 2', 'artist' => 'Artist 2', 'label' => 'Label 2', 'length' => '00:01:23', 'bpm_start' => '143.97', 'bpm_end' => '', 'key_start' => '11', 'key_end' => ''),
		array('id' => 30, 'setlist_id' => '6', 'setlist_order' => '3', 'title' => 'Weird BPM 3', 'artist' => 'Artist 3', 'label' => 'Label 3', 'length' => '00:01:23', 'bpm_start' => '139.55', 'bpm_end' => '', 'key_start' => '14', 'key_end' => ''),
		array('id' => 31, 'setlist_id' => '7', 'setlist_order' => '2', 'title' => 'Wrong Order 1', 'artist' => 'Artist 1', 'label' => 'Label 1', 'length' => '00:01:23', 'bpm_start' => '140.25', 'bpm_end' => '', 'key_start' => '9', 'key_end' => ''),
		array('id' => 32, 'setlist_id' => '7', 'setlist_order' => '2', 'title' => 'Wrong Order 2', 'artist' => 'Artist 2', 'label' => 'Label 2', 'length' => '00:01:23', 'bpm_start' => '143.97', 'bpm_end' => '', 'key_start' => '11', 'key_end' => ''),
		array('id' => 33, 'setlist_id' => '7', 'setlist_order' => '4', 'title' => 'Wrong Order 3', 'artist' => 'Artist 3', 'label' => 'Label 3', 'length' => '00:01:23', 'bpm_start' => '139.55', 'bpm_end' => '', 'key_start' => '14', 'key_end' => '')
	);
}
?>