<div class="row">
	<div class="col-md-12">
		<h2>Add Setlist</h2>
	</div>
</div>
<?php
echo $this->Form->create('Setlist', array(
	'inputDefaults' => array(
		'label' => false,
		/*'type' => 'text',*/
		'div' => false,
		'class' => 'form-control',
		'error' => array(
			'attributes' => array(
				'class' => 'alert alert-danger'
			)
		)
	)
));

$keyPreferenceOptions = array('c' => 'Camelot', 'o' => 'Open Key', 'n' => 'Notation');
$keyOptions = array();
switch ($setlist['Setlist']['key_preference']) {
	case 'o':
		$keyPreference = 'openkey';
		break;
	case 'n':
		$keyPreference = 'notation';
		break;
	case 'c':
	default:
		$keyPreference = 'camelot';
		break;
};

foreach ($keys as $key) {
	$keyOptions[$key['Key']['id']] = array('name' => $key['Key'][$keyPreference], 'value' => $key['Key']['id'], 'data-c' => $key['Key']['camelot'], 'data-o' => $key['Key']['openkey'], 'data-n' => $key['Key']['notation']);
}
?>
<div class="row">
	<div class="col-md-9">
		<table class="table table-bordered table-condensed">
			<tr>
				<td><?php echo $this->Form->label('Setlist.name', 'Setlist name'); ?></td>
				<td><?php echo $this->Form->input('Setlist.name'); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->label('Setlist.author'); ?></td>
				<td><?php echo $this->Form->input('Setlist.author'); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->label('Setlist.genre'); ?></td>
				<td><?php echo $this->Form->input('Setlist.genre'); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->label('Setlist.master_bpm', 'Master BPM'); ?></td>
				<td><?php echo $this->Form->input('Setlist.master_bpm'); ?></td>
			</tr>
		</table>
	</div>
	
	<div class="col-md-3">
		<div class="alert alert-info">
			<p class="lead">Required information</p>
			<p>Only <em>Setlist name</em>, <em>Author name</em> and <em>Track title</em> are required fields</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-bordered table-condensed" id="editForm">
			<thead>
				<tr>
					<th>#</th>
					<th>Artist</th>
					<th>Title</th>
					<th>Label</th>
					<th>Length</th>
					<th>BPM</th>
					<th>Key <?php echo $this->Form->select('Setlist.key_preference', $keyPreferenceOptions, array('empty' => false)); ?></th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php $numberTracks = 10;
					if (isset($this->data['Track'])) {
						if (count($this->data['Track']) > 10) {
							$numberTracks = count($this->data['Track']);
						}
					} ?>
			<?php for ($i = 0; $i < $numberTracks; $i++): ?>
				<tr>
				<?php echo $this->Form->input('Track.' . $i . '.setlist_order', array('type' => 'hidden', 'value' => $i + 1)); ?>
					<td class="draggable" style="white-space: nowrap;"><span class="glyphicon glyphicon-sort"></span> <label class="setlist_order"><?php echo $i + 1; ?></label></td>
					<td><?php echo $this->Form->input('Track.' . $i . '.artist', array('placeholder' => 'Artist')); ?></td>
					<td><?php echo $this->Form->input('Track.' . $i . '.title', array('placeholder' => 'Title')); ?></td>
					<td><?php echo $this->Form->input('Track.' . $i . '.label', array('placeholder' => 'Label')); ?></td>
					<td><?php echo $this->Form->input('Track.' . $i . '.length', array('type' => 'text', 'placeholder' => '00:00')); ?></td>
					<td><?php echo $this->Form->input('Track.' . $i . '.bpm_start', array('placeholder' => 'BPM')); ?></td>
					<td><?php echo $this->Form->select('Track.' . $i . '.key_start', $keyOptions, array('empty' => 'Key')); ?></td>
					<td><?php echo $this->Form->button('<span class="glyphicon glyphicon-remove-circle"></span>', array('type' => 'button', 'class' => 'btn btn-danger removeRowButton')); ?></td>
				</tr>
			<?php endfor; ?>
				<tr>
					<td colspan="7"><?php echo $this->Form->end(array('label' => 'Add Setlist', 'class' => 'btn btn-primary')); ?></td>
					<td><?php echo $this->Form->button('<span class="glyphicon glyphicon-plus-sign"></span>', array('type' => 'button', 'class' => 'btn btn-success addRowButton')); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {
	startSortable('#editForm');
	
	$('#editForm').on('click', '.addRowButton', addTrackRow);
	$('#editForm').on('click', '.removeRowButton', removeTrack);
	
	$('#SetlistKeyPreference').change(updateKeyPreference);
});
//]]>
</script>