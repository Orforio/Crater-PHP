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
		'bpm_start' => array('type' => 'integer', 'length' => 3, 'null' => true),
		'bpm_end' => array('type' => 'integer', 'length' => 3, 'null' => true),
		'key_start' => array('type' => 'string', 'length' => 3, 'null' => true),
		'key_end' => array('type' => 'string', 'length' => 3, 'null' => true)
	);
      
	public $records = array(
		array('id' => 1, 'setlist_id' => '1', 'setlist_order' => '1', 'title' => 'Track A', 'artist' => 'Artist A', 'label' => 'Label A', 'length' => '00:01:23', 'bpm_start' => '140', 'bpm_end' => '', 'key_start' => '3A', 'key_end' => ''),
		array('id' => 2, 'setlist_id' => '1', 'setlist_order' => '2', 'title' => 'Track B', 'artist' => 'Artist B', 'label' => 'Label B', 'length' => '00:02:34', 'bpm_start' => '138', 'bpm_end' => '', 'key_start' => '11B', 'key_end' => ''),
		array('id' => 3, 'setlist_id' => '1', 'setlist_order' => '3', 'title' => 'Track C', 'artist' => 'Artist C', 'label' => 'Label C', 'length' => '00:01:23', 'bpm_start' => '142', 'bpm_end' => '', 'key_start' => '3B', 'key_end' => ''),
		array('id' => 4, 'setlist_id' => '1', 'setlist_order' => '4', 'title' => 'Track D', 'artist' => 'Artist D', 'label' => 'Label D', 'length' => '00:01:23', 'bpm_start' => '140', 'bpm_end' => '', 'key_start' => '6B', 'key_end' => ''),
		array('id' => 5, 'setlist_id' => '1', 'setlist_order' => '5', 'title' => 'Track E', 'artist' => 'Artist E', 'label' => 'Label E', 'length' => '00:01:23', 'bpm_start' => '140', 'bpm_end' => '', 'key_start' => '6A', 'key_end' => ''),
		array('id' => 6, 'setlist_id' => '2', 'setlist_order' => '1', 'title' => 'Track F', 'artist' => 'Artist F', 'label' => 'Label F', 'length' => '00:01:23', 'bpm_start' => '180', 'bpm_end' => '', 'key_start' => '1A', 'key_end' => ''),
		array('id' => 7, 'setlist_id' => '2', 'setlist_order' => '2', 'title' => 'Track G', 'artist' => 'Artist G', 'label' => 'Label G', 'length' => '00:01:23', 'bpm_start' => '170', 'bpm_end' => '', 'key_start' => '2A', 'key_end' => ''),
		array('id' => 8, 'setlist_id' => '2', 'setlist_order' => '3', 'title' => 'Track H', 'artist' => 'Artist H', 'label' => 'Label H', 'length' => '00:01:23', 'bpm_start' => '178', 'bpm_end' => '', 'key_start' => '2B', 'key_end' => ''),
		array('id' => 9, 'setlist_id' => '2', 'setlist_order' => '4', 'title' => 'Track I', 'artist' => 'Artist I', 'label' => 'Label I', 'length' => '00:01:23', 'bpm_start' => '182', 'bpm_end' => '', 'key_start' => '3B', 'key_end' => ''),
		array('id' => 10, 'setlist_id' => '2', 'setlist_order' => '5', 'title' => 'Track J', 'artist' => 'Artist J', 'label' => 'Label J', 'length' => '00:01:23', 'bpm_start' => '184', 'bpm_end' => '', 'key_start' => '4B', 'key_end' => ''),
		array('id' => 11, 'setlist_id' => '3', 'setlist_order' => '1', 'title' => 'Track K', 'artist' => 'Artist K', 'label' => 'Label K', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '12A', 'key_end' => ''),
		array('id' => 12, 'setlist_id' => '3', 'setlist_order' => '2', 'title' => 'Track L', 'artist' => 'Artist L', 'label' => 'Label L', 'length' => '00:01:23', 'bpm_start' => '150', 'bpm_end' => '', 'key_start' => '6A', 'key_end' => ''),
		array('id' => 13, 'setlist_id' => '3', 'setlist_order' => '3', 'title' => 'Track M', 'artist' => 'Artist M', 'label' => 'Label M', 'length' => '00:01:23', 'bpm_start' => '142', 'bpm_end' => '', 'key_start' => '6B', 'key_end' => ''),
		array('id' => 14, 'setlist_id' => '3', 'setlist_order' => '4', 'title' => 'Track N', 'artist' => 'Artist N', 'label' => 'Label N', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '37B', 'key_end' => ''),
		array('id' => 15, 'setlist_id' => '3', 'setlist_order' => '5', 'title' => 'Track O', 'artist' => 'Artist O', 'label' => 'Label O', 'length' => '00:01:23', 'bpm_start' => '148', 'bpm_end' => '', 'key_start' => '2A', 'key_end' => ''),
		array('id' => 16, 'setlist_id' => '4', 'setlist_order' => '1', 'title' => 'Track P', 'artist' => 'Artist P', 'label' => 'Label P', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '3A', 'key_end' => ''),
		array('id' => 17, 'setlist_id' => '4', 'setlist_order' => '2', 'title' => 'Track Q', 'artist' => 'Artist Q', 'label' => 'Label Q', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '3A', 'key_end' => ''),
		array('id' => 18, 'setlist_id' => '4', 'setlist_order' => '3', 'title' => 'Track R', 'artist' => 'Artist R', 'label' => 'Label R', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '3A', 'key_end' => ''),
		array('id' => 19, 'setlist_id' => '4', 'setlist_order' => '4', 'title' => 'Track S', 'artist' => 'Artist S', 'label' => 'Label S', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '3A', 'key_end' => ''),
		array('id' => 20, 'setlist_id' => '4', 'setlist_order' => '5', 'title' => 'Track T', 'artist' => 'Artist T', 'label' => 'Label T', 'length' => '00:01:23', 'bpm_start' => '', 'bpm_end' => '', 'key_start' => '3A', 'key_end' => '')
	);
}
?>