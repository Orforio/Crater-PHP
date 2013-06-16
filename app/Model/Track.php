<?php
class Track extends AppModel {
	public $belongsTo = 'Setlist';
	public $helpers = array('Time');
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
				'rule' => 'numeric',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Please input a number for the Start BPM.'
			),
			'bpm_start_rule2' => array(
				'rule' => array('maxLength', 3),
				'message' => 'Please input a 3-digit BPM.'
			)
		),
		'bpm_end' => array(
			'bpm_end_rule1' => array(
				'rule' => 'numeric',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Please input a number for the End BPM.'
			),
			'bpm_end_rule2' => array(
				'rule' => array('maxLength', 3),
				'message' => 'Please input a 3-digit BPM.'
			)
		),
		'key_start' => array(
			'rule' => array('inList', array('Abm', 'B', 'Ebm', 'F#', 'Gb', 'Bbm', 'Db', 'Fm', 'Ab', 'G#', 'Cm', 'Eb', 'Gm', 'Bb', 'Dm', 'F', 'Am', 'C', 'Em', 'G', 'Bm', 'D', 'F#m', 'Gbm', 'A', 'Dbm', 'E')),
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Please provide a valid key. Use # for sharp, b for flat and m for minor.'
		),
		'key_end' => array(
			'rule' => array('inList', array('Abm', 'B', 'Ebm', 'F#', 'Gb', 'Bbm', 'Db', 'Fm', 'Ab', 'G#', 'Cm', 'Eb', 'Gm', 'Bb', 'Dm', 'F', 'Am', 'C', 'Em', 'G', 'Bm', 'D', 'F#m', 'Gbm', 'A', 'Dbm', 'E')),
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Please provide a valid key. Use # for sharp, b for flat and m for minor.'
		)
	);
	private $validKeys = array('Abm', 'B', 'Ebm', 'F#', 'Gb', 'Bbm', 'Db', 'Fm', 'Ab', 'G#', 'Cm', 'Eb', 'Gm', 'Bb', 'Dm', 'F', 'Am', 'C', 'Em', 'G', 'Bm', 'D', 'F#m', 'Gbm', 'A', 'Dbm', 'E');	// TODO: try and integrate this into getKeyCode below
	
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
				return null;
				break;
			default:
				throw new BadRequestException(__('Invalid key'));
		}
	}
	
	public function beforeSave($options = array()) {
		if ($this->data['Track']['length']) {
			$this->data['Track']['length'] = '00:' . $this->data['Track']['length'];
			$this->data['Track']['length'] = date('H:i:s', strtotime($this->data['Track']['length']));
		}
		
		return true;
	}
}
?>