<?php
App::uses('AppHelper', 'View/Helper');

class TrackHelper extends AppHelper {
	var $helpers = array('Number');

	public function displayBPM($bpm = null, $bpmDifference = null) {	// Formats supplied BPM difference according to +/-
		if ($bpm && is_numeric($bpm) && $bpmDifference === null) {
			return $this->Number->precision($bpm, 2);
		}
		elseif ($bpm && is_numeric($bpm) && $bpmDifference !== null && is_numeric($bpmDifference)) {
			if ($bpmDifference > 0) {
				return $this->Number->precision($bpm, 2) . ' <span class="text-info">+' . number_format($bpmDifference, 2) . '%</span>';
			}
			elseif ($bpmDifference < 0) {
				return $this->Number->precision($bpm, 2) . ' <span class="text-info">' . number_format($bpmDifference, 2) . '%</span>';
			}
			else {
				return $this->Number->precision($bpm, 2) . ' <span class="text-muted">=</span>';
			}
		}
		else {
			return '';
		}
	}
	
	public function displayKey($bpmDifference = null, $modifiedKey = null) {	// Formats changed key according to "safety", depending on BPM difference
		if (($bpmDifference === null || $modifiedKey === null) || (!is_numeric($bpmDifference) || !is_string($modifiedKey))) {
			return '';
		}
		else {
			$changeFactor = fmod(abs($bpmDifference) + 3, 6);
			
			if ($changeFactor >= 1.5 && $changeFactor <= 4.5) {
				return ' <span class="glyphicon glyphicon-arrow-right"></span> <span class="text-success">' . $modifiedKey . '</span>';
			}
			elseif ($changeFactor <= 0.5 || $changeFactor >= 5.5) {
				return ' <span class="glyphicon glyphicon-arrow-right"></span> <span class="text-danger">' . $modifiedKey . '</span>';
			}
			else {
				return ' <span class="glyphicon glyphicon-arrow-right"></span> <span class="text-warning">' . $modifiedKey . '</span>';
			}
		}
	}
}
?>