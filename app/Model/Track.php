<?php
class Track extends AppModel {
	public $belongsTo = 'Setlist';
	public $validate = array();
	
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
}
?>