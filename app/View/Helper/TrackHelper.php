<?php
App::uses('AppHelper', 'View/Helper');

class TrackHelper extends AppHelper {
	public function displayBPM($bpmDifference = null) {	// Formats supplied BPM difference according to +/-
		if ($bpmDifference === null || !is_numeric($bpmDifference)) {
			return '';
		}
		else {
			if ($bpmDifference > 0) {
				return ' <span class="text-info">+' . number_format($bpmDifference, 2) . '%</span>';
			}
			elseif ($bpmDifference < 0) {
				return ' <span class="text-info">' . number_format($bpmDifference, 2) . '%</span>';
			}
			else {
				return ' <span class="text-muted">=</span>';
			}
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