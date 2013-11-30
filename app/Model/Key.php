<?php
class Key extends AppModel {
	public $displayField = 'camelot';
	public $validate = array(
		'camelot' => array(
			'rule' => '/\A(?:1[0-2]|[1-9])[A|B]\z/',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Please enter a valid Camelot Key code.'
		),
		'openkey' => array(
			'rule' => '/\A(?:1[0-2]|[1-9])[m|d]\z/',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Please enter a valid OpenKey code.'
		),
		'notation' => array(
			'rule' => '/\A[A-G][♯♭]?[m]?\z/',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Please enter valid musical notation.'
		),
		'notation_enharmonic' => array(
			'rule' => '/\A[A-G][♯♭]?[m]?\z/',
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Please enter valid musical notation.'
		)
	);

	public $recursive = -1;
}
?>