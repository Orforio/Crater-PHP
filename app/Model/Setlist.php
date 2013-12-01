<?php
class Setlist extends AppModel {
	public $hasMany = array(
		'Track' => array(
			'dependent' => true,
			'order' => array('Track.setlist_order ASC'),
			)
		);
	public $validate = array(
		'name' => array(
			'rule' => array('maxLength', 255),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Please input a setlist name between 1 and 255 characters.'
		),
		'author' => array(
			'rule' => array('maxLength', 255),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Please input an author name between 1 and 255 characters.'
		),
		'genre' => array(
			'rule' => array('maxLength', 255),
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Please keep your genre name under 255 characters.'
		),
		'master_bpm' => array(
			'master_bpm_start_rule1' => array(
				'rule' => '/(?:\A\d{1,3}\.\d{1,2}\z|\A\d{1,3}\z)/',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Please enter a BPM between 1 and 999.99, maximum 2 decimal places.'
			),
			'master_bpm_start_rule2' => array(
				'rule' => array('maxLength', 6),
				'message' => 'Please enter a BPM below 999.99.'
			)
		)
	);

	public $recursive = -1;
	public $actsAs = array('Containable');

	public function calculateAverageBPM($data = null) {
    	if (!isset($data)) {
	    	return 0;
    	}
    	
    	$bpmTotal = 0;
    	$numberTracks = 0;
    	
    	foreach ($data as $track) {
	    	if (floatval($track['bpm_start'])) {
		    	$numberTracks++;
		    	$bpmTotal += $track['bpm_start'];
	    	}
    	}
    	
    	if ($numberTracks == 0) {
	    	return 0;
    	}
    	
    	return round($bpmTotal / $numberTracks);  
    }
    
    public function beforeSave($options = array()) {
		// debug($this->data);
	    // return false;
	    
	    return true;
    }

}
?>