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
			'rule' => array('custom', '/(^([1-9]|1[0-2])[abAB]$)|(^[a-gA-G][#b]?[m]?$)/'),	// Captures either Camelot code or key signature
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Please provide a valid key in either Key notation (eg F#, Bbm) or Camelot code (eg 7A, 12B).'
		),
		'key_end' => array(
			'rule' => array('custom', '/(^([1-9]|1[0-2])[abAB]$)|(^[a-gA-G][#b]?[m]?$)/'),	// Captures either Camelot code or key signature
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Please provide a valid key in either Key notation (eg F#, Bbm) or Camelot code (eg 7A, 12B).'
		)
	);
//	private $validKeys = array('Abm', 'B', 'Ebm', 'F#', 'Gb', 'Bbm', 'Db', 'Fm', 'Ab', 'G#', 'Cm', 'Eb', 'Gm', 'Bb', 'Dm', 'F', 'Am', 'C', 'Em', 'G', 'Bm', 'D', 'F#m', 'Gbm', 'A', 'Dbm', 'E');	// TODO: try and integrate this into getKeyCode below

		public function getKeyNotation($key) {	// Returns a key notation to display according to user preference
		switch ($key) {
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
			case "":
				return null;
				break;
			default:
				throw new BadRequestException(__('getKeyNotation: Invalid key'));
		}
	}
	
	public function getKeyCode($key) {	// Returns a Camelot Key Code for each given key
		switch ($key) {
			case "Abm":
				return "1A";
				break;
			case "B":
				return "1B";
				break;
			case "Ebm":
				return "2A";
				break;
			case "F#":
				return "2B";
				break;
			case "Gb":
				return "2B";
				break;
			case "Bbm":
				return "3A";
				break;
			case "Db":
				return "3B";
				break;
			case "Fm":
				return "4A";
				break;
			case "Ab":
				return "4B";
				break;
			case "G#";
				return "4B";
				break;
			case "Cm":
				return "5A";
				break;
			case "Eb":
				return "5B";
				break;
			case "Gm":
				return "6A";
				break;
			case "Bb":
				return "6B";
				break;
			case "Dm":
				return "7A";
				break;
			case "F":
				return "7B";
				break;
			case "Am":
				return "8A";
				break;
			case "C":
				return "8B";
				break;
			case "Em":
				return "9A";
				break;
			case "G":
				return "9B";
				break;
			case "Bm":
				return "10A";
				break;
			case "D":
				return "10B";
				break;
			case "F#m":
				return "11A";
				break;
			case "Gbm":
				return "11A";
				break;
			case "A":
				return "11B";
				break;
			case "Dbm":
				return "12A";
				break;
			case "E":
				return "12B";
				break;
			case "":
				return "";
				break;
			default:
				throw new BadRequestException(__('Invalid key'));
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
		
		return true;
	}
	
	public function afterFind($results, $primary = false) {	// Turns database 00:00:00 into 00:00 for user input
//		debug($results);
		foreach ($results as $i => $result) {
			if ($result['Track']['length']) {
				$results[$i]['Track']['length'] = date('i:s', strtotime($result['Track']['length']));
			}
		}
		
//		if ($results['Setlist']['master_bpm']) {
//			$results = $this->_calculateBPMDifference($results);
//		}
		
		return $results;
	}
	
	public function calculateBPMDifference($track, $masterBPM) {
		if ($track['bpm_start']) {
			$track['bpm_difference'] = round((($track['bpm_start'] - $masterBPM) / $masterBPM) * 100, 2);
		}
		else {
			$track['bpm_difference'] = null;
		}
		return $track;
	}
}
?>