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
			'message' => 'Please keep your setlist name under 255 characters.'
		),
		'author' => array(
			'rule' => array('maxLength', 255),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Please keep your author name under 255 characters.'
		),
		'genre' => array(
			'rule' => array('maxLength', 255),
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Please keep your genre name under 255 characters.'
		),
		'master_bpm' => array(
			'master_bpm_start_rule1' => array(
				'rule' => 'numeric',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Please input a number for the Master BPM.'
			),
			'master_bpm_start_rule2' => array(
				'rule' => array('maxLength', 3),
				'message' => 'Please input a 3-digit BPM.'
			)
		)
	);

	public $recursive = -1;

	public function calculateAverageBPM($data = null) {
    	if (!$data) {
	    	return 0;
    	}
    	
    	$bpmTotal = 0;
    	$numberTracks = 0;
    	
    	foreach ($data as $track) {
	    	if ($track['bpm_start']) {
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
		//debug($this->data);
	    //return false;
	    
	    return true;
    }
    
    public function afterFind($results, $primary = false) {
		$results = $this->afConvertBPM($results);
		
		return $results;
	}
	
	protected function afConvertBPM($results) {
		foreach ($results as $i => $result) {
			$results[$i]['Setlist']['master_bpm'] = $this->afConvertBPMReadable($result['Setlist']['master_bpm']);
		}
		
		return $results;
	}

}
?>