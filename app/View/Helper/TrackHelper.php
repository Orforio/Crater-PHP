<?php
App::uses('AppHelper', 'View/Helper');

class TrackHelper extends AppHelper {
	public function displayBPM($bpm_difference = null) {
		if ($bpm_difference === null || !is_numeric($bpm_difference)) {
			return '';
		}
		else {
			if ($bpm_difference > 0) {
				return ' <span class="track-bpm track-bpm-positive">+' . number_format($bpm_difference, 2) . '%</span>';
			}
			elseif ($bpm_difference < 0) {
				return ' <span class="track-bpm track-bpm-negative">' . number_format($bpm_difference, 2) . '%</span>';
			}
			else {
				return ' <span class="track-bpm track-bpm-equal">=</span>';
			}
		}
	}
}
?>