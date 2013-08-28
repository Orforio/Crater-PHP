<?php
App::uses('AppHelper', 'View/Helper');

class TrackHelper extends AppHelper {
	public function displayBPM($bpmDifference = null) {	// Formats supplied BPM difference according to +/-
		if ($bpmDifference === null || !is_numeric($bpmDifference)) {
			return '';
		}
		else {
			if ($bpmDifference > 0) {
				return ' <span class="track-bpm track-bpm-positive">+' . number_format($bpmDifference, 2) . '%</span>';
			}
			elseif ($bpmDifference < 0) {
				return ' <span class="track-bpm track-bpm-negative">' . number_format($bpmDifference, 2) . '%</span>';
			}
			else {
				return ' <span class="track-bpm track-bpm-equal">=</span>';
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
				return '<span class="track-key track-key-good">' . $modifiedKey . '</span>';
			}
			elseif ($changeFactor <= 0.5 || $changeFactor >= 5.5) {
				return '<span class="track-key track-key-bad">' . $modifiedKey . '</span>';
			}
			else {
				return '<span class="track-key track-key-borderline">' . $modifiedKey . '</span>';
			}
		}
	}
}
?>