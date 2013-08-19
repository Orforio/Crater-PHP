<h2>Edit Setlist</h2>
<?php
    echo $this->Form->create('Setlist', array(
		'inputDefaults' => array(
			'label' => false,
			'type' => 'text',
			'div' => false,
			'class' => 'form-control',
			'error' => array(
				'attributes' => array(
					'class' => 'alert alert-danger'))
			)
		));
	echo $this->Form->input('Setlist.id', array('type' => 'hidden'));
?>
<div class="alert alert-info"><strong>Edit Key</strong>: In order to be able to edit this setlist in the future, please note down your Edit Key (<strong><?php echo h($setlist['Setlist']['private_key']); ?></strong>) or <strong><?php echo $this->Html->link('save this edit link', array('controller' => 'setlists', 'action' => 'edit', $setlist['Setlist']['urlhash'], $setlist['Setlist']['private_key']), array('class' => 'alert-link')); ?></strong></div>
<table class="table table-bordered">
	<tr>
		<td><?php echo $this->Form->input('Setlist.name', array('label' => 'Name')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('Setlist.author', array('label' => 'Author')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('Setlist.genre', array('label' => 'Genre')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('Setlist.master_bpm', array('label' => 'Master BPM', 'class' => 'input-mini', 'placeholder' => $setlist['Setlist']['suggested_bpm'])); ?></td>
	</tr>
</table>

<table class="table table-striped table-bordered table-condensed" id="editForm">
	<thead>
		<tr>
			<th>#</th>
			<th>Artist</th>
			<th>Title</th>
			<th>Label</th>
			<th>Length</th>
			<th>BPM</th>
			<th>Key</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($setlist['Track'] as $i => $track):
?>
		<tr>
<?php
	echo $this->Form->input('Track.' . $i . '.id', array('type' => 'hidden'));
	echo $this->Form->input('Track.' . $i . '.setlist_order', array('type' => 'hidden'));
	$this->Form->unlockField('Track.' . $i . '.setlist_order');
?>
			<td class="draggable" style="white-space: nowrap;"><span class="glyphicon glyphicon-sort"><label class="setlist_order"> <?php echo h($track['setlist_order']); ?></label></span></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.artist'); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.title'); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.label'); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.length', array('placeholder' => '00:00')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.bpm_start', array('placeholder' => 'BPM')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.key_start', array('placeholder' => 'Key')); ?></td>
			<td><?php echo $this->Form->button('<span class="glyphicon glyphicon-remove-circle"></span>', array('type' => 'button', 'class' => 'btn btn-xs btn-danger removeRowButton')); ?></td>
		</tr>
<?php
	endforeach;
?>
	</tbody>
</table>
<div class="form-actions">
<p><?php echo $this->Form->button('Add row', array('type' => 'button', 'id' => 'addRowButton', 'class' => 'btn btn-sm btn-success')); ?></p>
<?php echo $this->Form->end(array(
	'label' => 'Save Setlist',
	'class' => 'btn btn-primary'
	));
?>
<?php echo $this->Form->postLink('Delete', array(
		'action' => 'delete',
		$setlist['Setlist']['urlhash'],
		$setlist['Setlist']['private_key']
		), array(
		'confirm' => 'Are you sure?',
		'class' => 'btn btn-danger')); ?>
</div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {
	startSortable('#editForm');
	
	$('#addRowButton').on('click', addTrackRow);
	$('.removeRowButton').on('click', removeTrackRow);
});
//]]>
</script>