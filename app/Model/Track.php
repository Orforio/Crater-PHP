<?php
class Track extends AppModel {
	public $belongsTo = 'Setlist';
	public $helpers = array('Time');
	public $recursive = -1;
	public $validate = array(
/*		'setlist_id' => array(	// Not present in HTTP Request
			'rule' => 'naturalNumber',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Missing setlist ID'
		),*/
		'setlist_order' => array(
			'rule' => 'naturalNumber',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Missing setlist_order, this should not appear.'
		),
		'title' => array(
			'rule' => array('maxLength', 255),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Please keep the track title under 255 characters.'
		),
		'artist' => array(
			'rule' => array('maxLength', 255),
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Please keep the artist name under 255 characters.'
		),
		'label' => array(
			'rule' => array('maxLength', 255),
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Please keep the label name under 255 characters.'
		),
		'length' => array(
			'rule' => array('custom', '/^([0-5]?[0-9]:[0-5]?[0-9]|[0-5]?[0-9])$/'),	// Captures mm:ss or just ss
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Please provide track length in mm:ss or ss format.'
		),
		'bpm_start' => array(
			'bpm_start_rule1' => array(
				'rule' => 'naturalNumber',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Please enter a BPM between 1 and 999.'
			),
			'bpm_start_rule2' => array(
				'rule' => array('maxLength', 3),
				'message' => 'Please enter a BPM below 999.'
			)
		),
		'bpm_end' => array(
			'bpm_end_rule1' => array(
				'rule' => 'naturalNumber',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Please enter a BPM between 1 and 999.'
			),
			'bpm_end_rule2' => array(
				'rule' => array('maxLength', 3),
				'message' => 'Please enter a BPM below 999.'
			)
		),
		'key_start' => array(
			'rule' => array('custom', '/(^([1-9]|1[0-2])[abAB]$)|(^[a-gA-G][#♯Bb♭]?[mM]?$)/'),	// Captures either Camelot code or key signature
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Please provide a valid key in either Key notation (eg F#, Bbm) or Camelot code (eg 7A, 12B).'
		),
		'key_end' => array(
			'rule' => array('custom', '/(^([1-9]|1[0-2])[abAB]$)|(^[a-gA-G][#♯Bb♭]?[mM]?$)/'),	// Captures either Camelot code or key signature
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Please provide a valid key in either Key notation (eg F#, Bbm) or Camelot code (eg 7A, 12B).'
		)
	);

		public function getKeyNotation($key = null) {	// Returns a key notation to display according to user preference
		switch (strtoupper($key)) {
			case "1A":
				return "A♭";
				break;
			case "1B":
				return "B";
				break;
			case "2A":
				return "E♭m";
				break;
			case "2B":
				return "F♯";
				break;
			case "3A":
				return "B♭m";
				break;
			case "3B":
				return "D♭";
				break;
			case "4A":
				return "Fm";
				break;
			case "4B":
				return "A♭";
				break;
			case "5A":
				return "Cm";
				break;
			case "5B";
				return "E♭";
				break;
			case "6A":
				return "Gm";
				break;
			case "6B":
				return "B♭";
				break;
			case "7A":
				return "Dm";
				break;
			case "7B":
				return "F";
				break;
			case "8A":
				return "Am";
				break;
			case "8B":
				return "C";
				break;
			case "9A":
				return "Em";
				break;
			case "9B":
				return "G";
				break;
			case "10A":
				return "Bm";
				break;
			case "10B":
				return "D";
				break;
			case "11A":
				return "F♯m";
				break;
			case "11B":
				return "A";
				break;
			case "12A":
				return "D♭m";
				break;
			case "12B":
				return "E";
				break;
			default:
				return '';
				break;
		}
	}
	
	public function getKeyCode($key = null) {	// Returns a Camelot Key Code for each given key
		$replaceFrom = array('♯', '♭');
		$replaceTo = array('#', 'b');
		
		$key = str_replace($replaceFrom, $replaceTo, $key);
		switch (strtolower($key)) {
			case "abm":
				return "1A";
				break;
			case "b":
				return "1B";
				break;
			case "ebm":
				return "2A";
				break;
			case "f#":
				return "2B";
				break;
			case "gb":
				return "2B";
				break;
			case "bbm":
				return "3A";
				break;
			case "db":
				return "3B";
				break;
			case "fm":
				return "4A";
				break;
			case "ab":
				return "4B";
				break;
			case "g#";
				return "4B";
				break;
			case "cm":
				return "5A";
				break;
			case "eb":
				return "5B";
				break;
			case "gm":
				return "6A";
				break;
			case "bb":
				return "6B";
				break;
			case "dm":
				return "7A";
				break;
			case "f":
				return "7B";
				break;
			case "am":
				return "8A";
				break;
			case "c":
				return "8B";
				break;
			case "em":
				return "9A";
				break;
			case "g":
				return "9B";
				break;
			case "bm":
				return "10A";
				break;
			case "d":
				return "10B";
				break;
			case "f#m":
				return "11A";
				break;
			case "gbm":
				return "11A";
				break;
			case "a":
				return "11B";
				break;
			case "dbm":
				return "12A";
				break;
			case "e":
				return "12B";
				break;
			default:
				return "";
				break;
		}
	}
	
	public function beforeSave($options = array()) {	// Turns 00:00 user input into 00:00:00 for database
		if ($this->data['Track']['length'] && (strlen($this->data['Track']['length']) != 8)) {
			$this->data['Track']['length'] = '00:' . $this->data['Track']['length'];
			$this->data['Track']['length'] = date('H:i:s', strtotime($this->data['Track']['length']));
		}
		
		if (!is_numeric(substr($this->data['Track']['key_start'], 0, 1))) {	// If first character of Key isn't numeric, we need to convert from key notation to a Camelot key code
			$this->data['Track']['key_start'] = $this->getKeyCode($this->data['Track']['key_start']);
		}
		else {	// Key is numeric, therefore valid Camelot Key Code, but let's make sure it's uppercase
			$this->data['Track']['key_start'] = strtoupper($this->data['Track']['key_start']);
		}
		
		return true;
	}
	
	public function afterFind($results, $primary = false) {	// Turns database 00:00:00 into 00:00 for user input
//		debug($results);
		foreach ($results as $i => $result) {
			if (isset($result['Track']['length'])) {
				$results[$i]['Track']['length'] = date('i:s', strtotime($result['Track']['length']));
			}
		}
		return $results;
	}
	
	public function calculateBPMDifference($track, $masterBPM) {
		if ($track['bpm_start']) {
			$track['bpm_difference'] = round((($masterBPM - $track['bpm_start']) / $track['bpm_start']) * 100, 2);
		}
		else {
			$track['bpm_difference'] = false;
		}
		return $track;
	}
	
	public function calculateKeyDifference($track = null) {
		if (($track['bpm_difference'] || $track['bpm_difference'] === (float)0) && $track['key_start']) {
			$roundedBPMDifference = intval($track['bpm_difference']);
			
			if ($roundedBPMDifference >= 3) {	// Tone goes up
				$toneDifference = intval(($roundedBPMDifference + 3) / 6);
				
				$keyCode = preg_split('/(\D)/', $track['key_start'], -1, PREG_SPLIT_DELIM_CAPTURE);
				$newKeyCodeNumber = (($keyCode[0] + (7 * $toneDifference)) % 12);
				if ($newKeyCodeNumber == 0) {
					$newKeyCodeNumber = 12;
				}
				$track['key_start_modified'] = $newKeyCodeNumber . $keyCode[1];
			}
			elseif ($roundedBPMDifference <= -3) {	// Tone goes down
				$toneDifference = abs(intval(($roundedBPMDifference - 3) / 6));
				
				$keyCode = preg_split('/(\D)/', $track['key_start'], -1, PREG_SPLIT_DELIM_CAPTURE);
				$newKeyCodeNumber = (($keyCode[0] - (7 * $toneDifference)) % 12);
				if ($newKeyCodeNumber < 0) {
					$newKeyCodeNumber += 12;
				}
				
				if ($newKeyCodeNumber == 0) {
					$newKeyCodeNumber = 12;
				}
				$track['key_start_modified'] = $newKeyCodeNumber . $keyCode[1];
			}
			else {
				$track['key_start_modified'] = $track['key_start'];
			}
			
			return $track;
		}
		elseif ($track) {
			$track['key_start_modified'] = '';
			
			return $track;
		}
		else {
			return '';
		}
	}
}
?>